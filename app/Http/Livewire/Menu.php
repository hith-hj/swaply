<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Notifyer;
use App\Models\Swap;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Menu extends Component
{
    public $user_location;
    public $user_phone;
    protected $listeners = ['refresh'];
    protected $user;

    public function mount(){
        $this->getUser();
        $this->emit('resizer');
    }

    public function hydrate(){
        $this->getUser();
        $this->emit('resizer');
    }

    public function refresh()
    {
        $this->getNotification();
    }

    public function getUser()
    {
        $this->user = User::find(Auth::id());
        $this->user->items = Item::all()->where('user_id',Auth::user()->id)->sortByDesc('created_at');
        $this->user->swaps = Swap::where('user_id','=',Auth::id())->orWhere('sender_id','=',Auth::id())->count();
        $this->user->notification = Notifyer::getnotifications(Auth::id());
        foreach($this->user->notification as $noti)
        {
            $noti->item = Item::find($noti->on_id);
        }
    }

    public function getNotification()
    {
        return Notifyer::getnotifications(Auth::id());
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
