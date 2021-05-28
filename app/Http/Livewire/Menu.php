<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Notifyer;
use App\Models\Requests;
use App\Models\Swap;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Menu extends Component
{
    public $user_location;
    public $user_phone;
    public $theme;
    public $post_type = 'حاجتك';
    protected $listeners = ['refresh','changeTheme'];
    protected $user;

    public function mount(){
        $this->getUser();
        $this->emit('resizer');
    }

    public function hydrate(){
        $this->getUser();
        $this->emit('resizer');
    }

    public function changeTheme($theme){
        $this->theme = $theme;
    }

    public function refresh()
    {
        $this->getAll();
    }

    public function getAll()
    {
        $this->getUser();
        $this->getNotification();
    }

    public function getUser()
    {
        $this->user = User::find(Auth::id());
        $this->user->items = Item::where([['user_id','=',Auth::id()],['status','!=','soft_deleted']])->get()->sortByDesc('updated_at');;
        $this->user->swaps = Swap::where('user_id','=',Auth::id())->orWhere('sender_id','=',Auth::id())->count();
        // $this->user->recommends = $this->getRecommends();
        $this->user->notification = $this->getNotification();        
    }

    private function getRecommends()
    {
        $items = Item::where([['user_id','=',Auth::id()],['status','=',0]])->get();
        foreach($items as $ikey=>$item){
            $item->recommends = Item::where([['user_id','!=',Auth::id()],['item_title','like','%' . $item->swap_with. '%'],['status','=',0]])->get();
            foreach($item->recommends as $rkey=>$reco)
            {
                $reco->requested = Requests::where([
                    ['item_id','=',$reco->id],
                    ['sender_id','=',Auth::id()]
                ])->exists();
                if($reco->requested == true){
                    $item->recommends->forget($rkey);
                }
            }
            if(count($item->recommends) == 0){
                $items->forget($ikey);
            }
        }
        return count($items);
    }

    public function getNotification()
    {
        // return Notifyer::getnotifications(Auth::id());
        $notis = Notifyer::getnotifications(Auth::id());
        foreach($notis as $noti)
        {
            $noti->item = Item::find($noti->on_id);
        }
        return $notis;
    }

    public function clearNotification($id)
    {
        $not = Notifyer::find($id);
           $not->status = 1;
           $not->save();
    }

    public function removeNotis()
    {
        foreach($this->user->notification as $key=>$val)
        {
           $not = Notifyer::find($val->id);
           $not->status = 1;
           $not->save();
        }
    }

    public function render()
    {
        $this->getUser();
        return view('livewire.menu',['user'=>$this->user]);
    }
}
