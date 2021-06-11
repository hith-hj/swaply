<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Requests;
use App\Models\Notifyer;
use App\Models\Report;
use App\Models\User;
use App\Models\Save;
use App\Models\Swap;

use Illuminate\Support\Facades\DB;
class Showitem extends Component
{
    protected $item;
    public $item_id;
    public $repo;
    public $req_item;
    public $req_info;
    public $editedFeed;
    protected $listeners = ['refresh'];
    protected $notis = [
        ['تم حفظ المنشور','b','حسنا',],
        ['حدث خطا ما','r','للاسف',],
        ['استلمنا بلاغك سوف نتابع الموضوع ,شكرا لتعاونك','b','حسنا',],
        ['لم يتم ارسال البلاغ,الرجاء المحاولة لاحقا','r','للاسف',],
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

    public function refresh()
    {
        $this->getItem($this->item_id);
    }

    public function getItem($id)
    {
        $item = Item::find($id);
        $stat = $item != null ? true : false;
        if($stat == true && $item->status != 'soft_deleted'){
            $this->itemEditInfo($item);
            Item::incViews($id);
            $this->item = $this->getItemData($item,$id);
            $this->item = $this->checkItemStatus($this->item);           
            if($this->item->user_id != Auth::id()){
                $this->item = $this->checkIfRequested($this->item);
                $this->item = $this->checkIfRecived($this->item);
            }
        }else{
            return $this->item = [];
        }
    }

    public function getItemData($item,$id)
    {
        $item->user = User::find($item->user_id);
        $item->requestsCount = $item->requests;
        $item->collection = unserialize($item->collection);
        $item->user_items = Item::where([['user_id','=',Auth::id()],['status','=','0'],['item_type','!=','3'],])->get();
        $item->requests = Requests::where('item_id',$id)->get();
        return $item;
    }

    public function checkItemStatus($item)
    {
        if($item->user_id == Auth::id())
            {
                if($item->status == '1'){
                    $item->requests->filter(function($req) use ($item){
                        if($req->status == '1'){
                            $item->sender_id = User::find($req->sender_id);
                            switch ($item->item_type) {
                                case '1':
                                    $item->sender_item == Item::find($req->sender_item);
                                    break;
                                case '2':
                                    if($req->sender_item != 'trade')
                                    {
                                        $item->sender_item == Item::find($req->sender_item);
                                    }else{
                                        $item->sender_item == 'trade';
                                    }
                                    break;                                
                                default:
                                    # code...
                                    break;
                            }
                            return $req;
                        }
                    });
                }else{
                    foreach ($item->requests as $key => $req) {
                        $item->sender = User::find($req->sender_id);
                        if($item->item_type != '3' && $req->sender_item != 'trade'){
                            $req->sender_item = Item::find($req->sender_item);
                            $req->sender_item->collection = unserialize($req->sender_item->collection);
                        }
                    }
                }
            }
        return $item;
        // if($this->item->user_id == Auth::id())
        // {
        //     if($this->item->status == '1'){
        //         $this->item->requests->filter(function($req){
        //             if($req->status == '1'){
        //                 $this->item->sender_id = User::find($req->sender_id);
        //                 switch ($this->item->item_type) {
        //                     case '1':
        //                         $this->item->sender_item == Item::find($req->sender_item);
        //                         break;
        //                     case '2':
        //                         if($req->sender_item != 'trade')
        //                         {
        //                             $this->item->sender_item == Item::find($req->sender_item);
        //                         }else{
        //                             $this->item->sender_item == 'trade';
        //                         }
        //                         break;                                
        //                     default:
        //                         # code...
        //                         break;
        //                 }
        //                 return $req;
        //             }
        //         });
        //     }else{
        //         foreach ($this->item->requests as $key => $req) {
        //             $this->item->sender = User::find($req->sender_id);
        //             if($this->item->item_type != '3' && $req->sender_item != 'trade'){
        //                 $req->sender_item = Item::find($req->sender_item);
        //                 $req->sender_item->collection = unserialize($req->sender_item->collection);
        //             }
        //         }
        //     }
        // } 
    }

    public function itemEditInfo($item)
    {
        $this->editedFeed['item_title'] = $item->item_title;
        $this->editedFeed['item_info'] = $item->item_info;
        $this->editedFeed['item_location'] = $item->item_location;
        $this->editedFeed['swap_with'] = $item->swap_with;
    }

    public function checkIfRequested($item):object
    {
        $item->requested = Requests::where([
            ['item_id','=',$item->id],
            ['sender_id','=',Auth::id()]
        ])->exists();
        return $item;
    }

    public function checkIfRecived($item)
    {
        $item->recived = Requests::where([
            ['sender_item','=',$item->id],
            ['user_id','=',Auth::id()]
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

    public function setRequestViewed($request_id)
    {
        $req = Requests::find($request_id);
        if($req == true && $req != null)
        {
            if($req->viewed == '0')
            {
                $req->viewed += 1;
                $req->save();
            }            
            $this->emitSelf('refresh');
        }
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
        
        Notifyer::store(Auth::id(),$sender_id,'تم قبول العرض',$item_id);
        $this->emit('notifi',$this->notis[5]);
        $this->emitTo('body','changeBody','swaps');
    }

    public function editItem($item_id)
    {
        $toReplace = [0,1,2,3,4,5,6,7,8,9,'٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        try {
            $item = Item::find($item_id);
            $item->item_title = str_replace($toReplace,'',$this->editedFeed['item_title']);
            $item->item_info = str_replace($toReplace,'',$this->editedFeed['item_info']);
            $item->item_location = str_replace($toReplace,'',$this->editedFeed['item_location']);
            $item->swap_with = str_replace($toReplace,'',$this->editedFeed['swap_with']);
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

    public function oldDelete($item_id)
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

    public function report($post_id,$user_id):void
    {
        $res = false;
        if($this->repo != null && count($this->repo) == 2)
        {
            Report::create([
                'user_id'=>$user_id,
                'maker_id'=>Auth::user()->id,
                'post_id'=>$post_id,
                'report_type'=>$this->repo['type'],
                'report_info'=>$this->repo['info'],
            ]);
            $res = Notifyer::store(Auth::id(),$user_id,'تم تبليغ عن منشورك,الرجاء تعديل او ازالة المنشور',$post_id);
        }
        $res == true 
        ? $this->emit('notifi',$this->notis[2]) 
        : $this->emit('notifi',$this->notis[3]);
    }

    public function resetReport()
    {
        $this->report_type = '';
        $this->report_info = '';
    }

    public function render()
    {
        return view('livewire.showitem',['feed'=>$this->item]);
    }
}
