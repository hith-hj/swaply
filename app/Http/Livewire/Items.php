<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;
use App\Models\Save;
use App\Models\Report;
use App\Models\Notifyer;
use App\Models\Requests;

class Items extends Component
{
    protected $feeds;
    
    public function getItems()
    {
        $this->feeds = Item::all()->where('user_id',Auth::id());
        $this->feeds->each(function($feed){
            $feed->collection = unserialize($feed->collection);
        });
    }

    public function render()
    {
        $this->getItems();
        return view('livewire.items',['feeds'=>$this->feeds]);
    }
}
