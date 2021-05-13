<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Requests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Recommends extends Component
{
    public $items;
    public function mount()
    {
        $this->getRecommends();
    } 

    public function getRecommends()
    {
        $items = Item::where([['user_id','=',Auth::id()],['status','=',0]])->get();
        foreach($items as $ikey=>$item){
            $item->recommends = Item::where([['user_id','!=',Auth::id()],['item_title','like','%' . $item->swap_with. '%'],['status','=',0]])->get();
            foreach($item->recommends as $rkey=>$reco)
            {
                $reco->collection = unserialize($reco->collection);
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
        $this->items = $items;
    }

    public function render()
    {
        return view('livewire.recommends');
    }
}
