<?php

namespace App\Http\Livewire\Reqs;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Notifyer;
use App\Models\Requests;

class Swap extends Component
{
    public $feed;
    public $req_item;

    protected $notis = [
        ['لم يتم ارسال الطلب ,الرجاء املئ الحقل المطلوب','r','للاسف',],
        ['تم إرسال الطلب','g','حسنا',],
        ['لا يمكنك ارسال طلب المنشور تم تبديلة ','r','للأسف',],
    ];

    public function mount($feed)
    {
        $this->feed = $feed;
    }

    public function sendOffer($item_id,$user_id,$item_type)
    {
        $off = false;
        if($this->req_item != null && $this->req_item != ''){
            if(Item::find($item_id)->status != 0){
                return $this->emit('notifi',$this->notis[2]);
            }
            $off = Requests::create([
                'user_id'=>$user_id,
                'item_id'=>$item_id,            
                'request_type'=>$item_type,
                'sender_id'=> Auth::user()->id,
                'sender_item'=>$this->req_item,
            ]);
            Item::incRequests($item_id);
            Notifyer::store(Auth::id(),$user_id,'تم استلام عرض جديد',$item_id);
        }
        $this->emitUp('refresh');
        $this->resetOffer();
        if($off == true){ 
            $this->emit('notifi',$this->notis[1]);
            return $this->emit('changeBody','feeds');
        }else{
            $this->emit('notifi',$this->notis[0]);
        } 
    }

    public function resetOffer()
    {
        $this->req_item = '';
    }

    public function render()
    {
        return view('livewire.reqs.swap');
    }
}
