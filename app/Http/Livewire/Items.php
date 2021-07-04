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
    protected $notis = [
        ['تم حفظ المنشور','b','حسنا',],
        ['حدث خطا ما','r','للاسف',],
        ['تم حذف المنشور','r','للاسف'],
        ['','',''],
        ['','',''],
    ];
    
    public function getItems()
    {
        $this->feeds = Item::where([['user_id','=',Auth::id()],['status','!=','soft_deleted']])->get()->sortByDesc('created_at');
        $this->feeds->each(function($feed){
            $feed->collection = unserialize($feed->collection);
        });
    }

    public function completeItemInfo($item_id)
    {
        $notis= [['تم اكمال البيانات تم نشر غرضك','g','حسنا'],['اكمل بيانات الموقع الخاصة بك','r','خطأ']];
        $item = Item::find($item_id);
        if(!$item || Auth::user()->location == 'not-set'){
            return $this->emit('notifi',$notis[1]);
        }
        $item->status = 0;
        $item->item_location = Auth::user()->location;
        $item->save();
        $this->emit('notifi',$notis[0]);
        return $this->getItems();
    }

    public function deleteItem($item_id)
    {
        
        try {
            $ite = Item::find($item_id);
            $ite->status = 'soft_deleted';
            $ite->save();
            $this->emit('notifi',$this->notis[2]);
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
