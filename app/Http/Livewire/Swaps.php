<?php

namespace App\Http\Livewire;

use App\Models\Swap;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Swaps extends Component
{
    public $swaps;

    public function mount()
    {
        $this->getSwaps();
    }

    public function getSwaps()
    {
        $this->swaps = Swap::where('user_id','=',Auth::id())->orWhere('sender_id','=',Auth::id())->get();
        foreach($this->swaps as $sw)
        {
            $sw->user = User::find($sw->user_id);
            $sw->sender = User::find($sw->sender_id);
            $sw->user_item = Item::find($sw->item_id);
            $sw->user_item->collection = unserialize($sw->user_item->collection);
            $sw->sender_item = Item::find($sw->sender_item);
            $sw->sender_item->collection = unserialize($sw->sender_item->collection);
        }
    }

    public function render()
    {
        return view('livewire.swaps');
    }
}
