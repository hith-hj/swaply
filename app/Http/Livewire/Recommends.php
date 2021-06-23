<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $items = Item::where([['user_id','=',Auth::id()],['status','=','0'],['item_type','!=','3']])->get();
        foreach($items as $ikey=>$item){
            switch ($item->item_type) {
                case '1':
                    $item->recommends = Item::where('item_title','like','%'.$item->swap_with.'%')->get();
                    break;
                case '2':
                    $item->recommends = Item::where('swap_with','like','%'.$item->item_title.'%')->get();
                    break; 
                case '4':
                    $item->recommends = Item::where([['item_type','=','2'],['item_title','like','%'.$item->item_title.'%'],])->get();
                    break;               
                default:
                    // $item->recommends = Item::where('item_title','like','%'.$item->swap_with.'%')->get();
                    break;
            }
            foreach($item->recommends as $rkey=>$reco){
                $reco->collection = unserialize($reco->collection);
                $reco->requested = Requests::where([
                    ['item_id','=',$reco->id],
                    ['sender_id','=',Auth::id()]
                ])->exists();
                if($reco->requested == true || $reco->user_id == Auth::id() || $reco->status != '0'){
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
