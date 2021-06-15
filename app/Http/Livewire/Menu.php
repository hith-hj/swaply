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
    public $userInfo;
    public $email;
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
            $item->recommends = Item::where([['user_id','!=',Auth::id()],['item_title','like','%' . $item->swap_with. '%'],['status','=','0']])->get();
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

    public function setUserEmail()
    {
        if($this->email != null)
        {
            $rules = ['email'=>'string|email|max:255|unique:users'];
            $val = $this->validate($rules);
            $user = User::find(Auth::id());
            $user->email = $this->email;
            $user->save();
            $noti=['تم حفظ البريد الألكتروني','b','حسنا'];
            $this->emit('notifi',$noti);
            $this->getUser();
        }
    }

    public function updateInfo()
    {
        dd($this->userInfo);
        $noti = [['تم اضافة معلومات ','g','حسنا'],
            ['املئ الحقول المطلوبة','r','خطا'],
            ['الرقم المدخل لايطابق الشروط','r','خطا'],
        ];
        if( ( is_array($this->userInfo->location) && 
        count($this->userInfo->location) == 2 ) || 
        isset($this->userInfo->phone)
        ){
            preg_match('/(01)[0125]\d{8}/',$this->user_phone,$mat);
            if(count($mat) < 2)
            {
                return $this->emit('notifi',$noti[2]);
            }
            $this->user = User::find(Auth::user()->id);
            $this->user->location = $this->user_location['covernent']
            .'-'.$this->user_location['area']
            .'-'.$this->user_location['naighbor'];
            $this->user->phone = $this->user_phone;
            $this->user->save();
            $this->emit('notifi',$noti[0]);
        }else{
            $this->emit('notifi',$noti[1]);
        }
        $this->emit('changeBody','feeds');
    }

    public function render()
    {
        // $this->getUser();
        return view('livewire.menu',['user'=>$this->user]);
    }
}
