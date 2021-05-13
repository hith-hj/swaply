<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Requests;
use App\Models\Notifyer;
use App\Models\User;
use App\Models\Save;
use App\Models\Swap;

use Illuminate\Support\Facades\DB;
class Showitem1 extends Component
{
    protected $item;
    public $item_id;
    public $req_item;
    public $req_info;
    public $editedFeed;
    protected $notis = [
        ['تم حفظ المنشور','b','حسنا',],
        ['حدث خطا ما','r','للاسف',],
        ['استلمنا بلاغك سوف نتابع الموضوع ,شكرا لتعاونك','b','حسنا',],
        ['لم يتم ارسال البلاغ,الرجاء المحاولة لاحقا','r','للاسف',],
        ['لم يتم ارسال العرض,الرجاء المحاولة لاحقا','r','للاسف',],
        ['تم تقديم العرض بنجاح','g','حسنا',],
        ['تم قبول العرض سوف يتم حذف باقي العروض المستلمة على هذا المنشور','g','حسنا',],
        ['تم تعديل المنشور','g','حسنا'],
        ['املأ الحقول المطلوبة','r','خطا'],
        ['تم حذف المنشور','r','للاسف'],
        ['','',''],
        ['','',''],
    ];

    public function mount($g_id)
    {
        $this->item_id = $g_id;
        $this->getItem($g_id);
    }

    public function hydrate()
    {
        $this->getItem($this->item_id);
    }

    public function getItem($id)
    {
        $this->item = Item::find($id);
        if($this->item == null )
        {
            return $this->item = [];
        }
        $this->item->views += 1;
        $this->item->save();
        $this->item->user = User::find($this->item->user_id);
        $this->item->requestsCount = $this->item->requests;
        $this->item->collection = unserialize($this->item->collection);
        $this->item->user_items = Item::all()->where("user_id",Auth::user()->id);
        $this->item->requests = Requests::where('item_id',$id)->orWhere('sender_item',$id)->get();
        if($this->item->status == 1)
        {
            $this->item->requests->filter(function($req){
                if($req->status == 1)
                {
                    if($req->user_id == Auth::id()){
                        $uid = $req->sender_id;
                        $uitem = $req->sender_item;
                    }else{
                        $uid = $req->user_id;
                        $uitem = $req->item_id;
                    }
                    $this->item->sender = User::find($uid);
                    $this->item->sender_item = Item::find($uitem);
                    return $req;
                }
            });
        }else{
            foreach($this->item->requests as $req){
                $req->sender = User::find($req->sender_id);
                if($req->item_type == 1){
                    $req->sender_item = Item::find($req->sender_item);
                    $req->sender_item->collection = unserialize($req->sender_item->collection);
                }
            }
        }
        $this->editedFeed['item_title'] = $this->item->item_title;
        $this->editedFeed['item_info'] = $this->item->item_info;
        $this->editedFeed['item_location'] = $this->item->item_location;
        $this->editedFeed['swap_with'] = $this->item->swap_with; 
        
        if($this->item->user_id != Auth::id()){
            $this->item = $this->checkIfRequested($this->item);
        }
        // dd($this->item);
    }

    /**
     * @return object if requested by the viewer
     */
    public function checkIfRequested($item):object
    {
        $item->requested = Requests::where([
            ['item_id','=',$item->id],
            ['sender_id','=',Auth::id()]
        ])->exists();
        return $item;
    }

    public function savePost($postId)
    {
        try {
            $sa = new Save();
            $sa->user_id = Auth::id();
            $sa->post_id = $postId;
            $sa->save(); 
            $this->emit('notifi',$this->notis[0]);
        } catch (\Throwable $th) {
            $this->emit('notifi',$this->notis[1]);
        }
        
    }

    public function sendOffer($item_id,$user_id,$item_type)
    {
        $off = false;
        if($this->req_item != null){
            $off = Requests::create([
                'user_id'=>$user_id,
                'item_id'=>$item_id,            
                'item_type'=>$item_type,
                'sender_id'=> Auth::user()->id,
                'sender_item'=>$this->req_item,
            ]);
            Item::incRequests($item_id);
            Notifyer::store(Auth::id(),$user_id,'تم استلام عرض جديد',$item_id);
        }
        $off == true ? $this->emit('notifi',$this->notis[5]) : $this->emit('notifi',$this->notis[4]);
        $this->resetOffer();
    }
    
    public function resetOffer()
    {
        $this->req_info = '';
        $this->req_item = '';
    }

    public function acceptRequest($request_id,$user_id,$sender_id,$item_id,$sender_item)
    {
        $swaps = Swap::create([
            'request_id'=>$request_id,
            'user_id'=>$user_id,
            'sender_id'=>$sender_id,
            'item_id'=>$item_id,
            'sender_item'=>$sender_item,
        ]);
        if($swaps != true)
        {
            return $this->emit('notifi',$this->notis[2]);
        }

        $request = Requests::find($request_id);
        $request->status = 1;        
        $request->save();

        if($request != true)
        {
            return $this->emit('notifi',$this->notis[2]);
        }
        $reqs = Requests::where([
            ['item_id','=',$item_id],
            ['status','=',0],
            ]);
        $reqs->each(function($req){
            $req->status = -1;
            return $req->save();
        });
        $item = Item::find([$item_id,$sender_item]);
        $item->each(function($it){
            $it->status = 1;
            return $it->save();
        });
        $this->emit('notifi',$this->notis[5]);
        $this->emitTo('body','changeBody','swaps');
    }

    public function editItem($item_id)
    {
        try {
            $item = Item::find($item_id);
            $item->item_title = $this->editedFeed['item_title'];
            $item->item_info = $this->editedFeed['item_info'];
            $item->item_location = $this->editedFeed['item_location'];
            $item->swap_with = $this->editedFeed['swap_with'];
            $item->save();
            $this->emit('notifi',$this->notis[7]);
            $this->emit('changeBody',['showitem',$item_id]);
        } catch (\Throwable $th) {
            $this->emit('notifi',$this->notis[8]);
        }
    }

    public function deleteItem($item_id)
    {
        
        try {
            $reqs = DB::table('requests')->where('item_id','=',$item_id)->orWhere('sender_item','=',$item_id);
            $reqs->delete();
            $noti = DB::table('notifications')->where('on_id','=',$item_id);
            $noti->delete();
            $ite = Item::find($item_id);
            if(Storage::disk('items')->exists($ite->directory)){
                Storage::disk('items')->deleteDirectory($ite->directory);
            }
            $ite->delete();
            $this->emit('notifi',$this->notis[9]);
        } catch (\Throwable $th) {
            $this->emit('notifi',$this->notis[1]);
        }finally{
            $this->emit('changeBody','feeds');
        }
    }

    public function render()
    {
        return view('livewire.showitem1',['feed'=>$this->item]);
    }
}
