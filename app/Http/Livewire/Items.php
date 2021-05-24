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
        $this->feeds = Item::where([['user_id','=',Auth::id()],['status','!=','soft_deleted']])->get()->sortByDesc('created_at');
        $this->feeds->each(function($feed){
            $feed->collection = unserialize($feed->collection);
        });
    }

    public function deleteItem($item_id)
    {
        
        try {
            $ite = Item::find($item_id);
            $ite->status = 'soft_deleted';
            $ite->save();
            $this->emit('notifi',$this->notis[9]);
        } catch (\Throwable $th) {
            $this->emit('notifi',$this->notis[1]);
        }finally{
            $this->emit('changeBody','items');
        }
    }

    public function render()
    {
        $this->getItems();
        return view('livewire.items',['feeds'=>$this->feeds]);
    }
}
