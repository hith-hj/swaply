<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Requests;
use App\Models\Notifyer;
use App\Models\Payment;
use App\Models\Report;
use App\Models\User;
use App\Models\Save;
use App\Models\Swap;
use Carbon\Carbon;
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
        ['تم قبول العرض','g','حسنا',],
        ['تم تعديل المنشور','g','حسنا'],        
        ['تم حفظ المنشور','b','حسنا',],
        ['استلمنا بلاغك سوف نتابع الموضوع ,شكرا لتعاونك','b','حسنا',],        
        ['لم يتم ارسال البلاغ,الرجاء المحاولة لاحقا','r','للاسف',],
        ['املأ الحقول المطلوبة','r','خطا'],
        ['تم حذف المنشور','r','للاسف'],
        ['حدث خطا ما','r','للاسف',],
        ['لايمكن اتمام هذة العملية البيانات غير متوافقة','r','للاسف '],
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
            $item->views += 1;
            $item->save();
            $this->itemEditInfo($item);
            // Item::incViews($id);
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
        // $item->user = User::find($item->user_id);
        $item->requestsCount = $item->requests;
        $item->collection = unserialize($item->collection);
        $item->user_items = Item::where([['user_id','=',Auth::id()],
        ['status','=','0'],
        ['item_type','!=','3'],
        ])->get();
        $item->requests = Requests::where([['item_id','=',$id],['status','!=','-1'],])->get();
        return $item;
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

    public function checkItemStatus($item)
    {
        if($item->user_id == Auth::id())
        {
            if($item->status == '1'){
                $item->requests->filter(function($req) use ($item){
                    if($req->status == '1'){
                        $item->sender = User::find($req->sender_id);
                        switch ($item->item_type) {
                            case '1':
                                $item->sender_item = Item::find($req->sender_item);
                                break;
                            case '2':
                                if($req->sender_item == 'trade')
                                {
                                    $item->sender_item = 'trade';
                                }else{
                                    $item->sender_item = Item::find($req->sender_item);
                                }
                                break;
                            default:
                                # do nothing for now
                                break;
                        }
                        return $req;
                    }
                });
            }else{
                $payment = Payment::where('item_id','=',$item->id);
                if($payment->exists())  {
                    $payment = $payment->first();
                    $item->payment = $payment;  
                    if($payment->payment_status != 'paid') {
                        if(Carbon::now()->greaterThan(Carbon::create($payment->payment_expire_date))) {
                            $request = Requests::find($payment->request_id);
                            $request->status = -1;
                            $request->save();
                            $payment->delete();
                            $itm = Item::find($item->id);
                            $itm->status = 0;
                            $itm->save();
                        }else{
                            $item->paid = false;
                        }                  
                    }else{
                        $item->paid = true;
                        $request = Requests::where('id','=',$payment->request_id)->first();
                        $this->accept($item,$request);
                    }
                }else{
                    $item->payment = false;              
                    foreach ($item->requests as $key => $req) {
                        $item->sender = User::find($req->sender_id);
                        if($item->item_type != '3' && $req->sender_item != 'trade'){
                            $req->sender_item = Item::find($req->sender_item);
                            $req->sender_item->collection = 
                            unserialize($req->sender_item->collection);
                        }
                    }
                }                
            }
        }
        return $item;
    }

    public function acceptRequest($item_id,$request_id)
    {
        $item = Item::find($item_id);
        $item->payment = true;
        return $this->accept($item,Requests::find($request_id));
        dd('stop');
        $item = Item::find($item_id);
        $item->status = 0.5;
        $item->save();
        $request = Requests::find($request_id);
        $request->status = 'payment';
        $request->save();
        if($item->item_type == '3') {
            $item->payment = true;
            return $this->accept($item,$request);
        }elseif($item->item_type == '2' && $request->sender_item == 'trade'){
            $this->setPayment($item,$request,'.05');
        }else{
            $this->setPayment($item,$request);
        }
        $this->emit('refresh');
    }

    public function setPayment($item,$request, float $percent= 20){
        $amount = $percent == '20' 
        ? $percent 
        : round($item->amount - $item->amount * 0.9525);
        $pay = new Payment();
        $pay->request_id = $request->id;
        $pay->item_id = $item->id;
        $pay->payer_id = Auth::id();
        $pay->merchantCode = rand(1000000,9999999999);
        $pay->payment_amount = $amount;
        $pay->payment_expire_date = Carbon::now()->add('24','hour');
        $pay->save();
        $this->emitSelf('refresh');
    }

    public function accept($item,$request)
    {
        if($request!=null && $item->payment==true){           

            if($item->item_type == '3'){
                $sender_item = 'donate';
            }elseif($item->item_type == '2' && $request->sender_item == 'trade'){
                $sender_item = 'trade';
            }else{
                $sender_item = Item::find($request->sender_item);
                $sender_item->status = 1;
                $sender_item->save();
            }

            $reqs = Requests::where([
                ['item_id','=',$item->id],
                ['status','=',0],
                ]);
            $reqs->each(function($req){
                $req->status = -1;
                $req->save();
            });            

            $swaps = Swap::create([
                'request_id'=>$request->id,
                'user_id'=>Auth::id(),
                'sender_id'=>$request->sender_id,
                'item_id'=>$item->id,
                'sender_item'=>$sender_item,
            ]);
            if($swaps != true){
                return $this->emit('notifi',$this->notis[8]);
            }
            $request->status = 1;        
            $request->save();
            $itm = Item::find($item->id);
            $itm->status = 1;
            $itm->save();
            if($request != true || $item != true){
                return $this->emit('notifi',$this->notis[8]);
            } 
            Notifyer::store(Auth::id(),$request->sender_id,'تم قبول الطلب',$item->id);
            $this->emit('notifi',$this->notis[0]);
            $this->emitTo('body','changeBody','swaps');
        }else{
            $this->emit('notifi',$this->notis[7]);
        }
        // dd('done');
    }

    public function savePost($postId)
    {
        try {
            $sa = new Save();
            $sa->user_id = Auth::id();
            $sa->post_id = $postId;
            $sa->save(); 
            $this->emit('notifi',$this->notis[2]);
        } catch (\Throwable $th) {
            $this->emit('notifi',$this->notis[7]);
        }
        
    }

    public function setRequestViewed($request_id)
    {
        $req = Requests::find($request_id);
        if($req == true && $req != null){
            if($req->viewed == '0'){
                $req->viewed += 1;
                $req->save();
            }            
            $this->emitSelf('refresh');
        }
    }

    public function editItem($item_id)
    {
        $toReplace = [0,1,2,3,4,5,6,7,8,9,'٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        try {
            $item = Item::find($item_id);
            $item->item_title = 
            str_replace($toReplace,'',$this->editedFeed['item_title']);
            $item->item_info = 
            str_replace($toReplace,'',$this->editedFeed['item_info']);
            $item->item_location = 
            str_replace($toReplace,'',$this->editedFeed['item_location']);
            $item->swap_with = 
            str_replace($toReplace,'',$this->editedFeed['swap_with']);

            $item->save();
            $this->emit('notifi',$this->notis[1]);
            $this->emit('changeBody',['showitem',$item_id]);
        } catch (\Throwable $th) {
            $this->emit('notifi',$this->notis[5]);
        }
    }

    public function deleteItem($item_id)
    {
        
        try {
            $ite = Item::find($item_id);
            $ite->status = 'soft_deleted';
            $ite->save();
            $this->emit('notifi',$this->notis[6]);
        } catch (\Throwable $th) {
            $this->emit('notifi',$this->notis[7]);
        }finally{
            $this->emit('changeBody','items');
        }
    }

    public function oldDelete($item_id)
    {
        
        try {
            $reqs = DB::table('requests')
            ->where('item_id','=',$item_id)
            ->orWhere('sender_item','=',$item_id);
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
        if($this->repo != null && count($this->repo) == 2){
            Report::create([
                'user_id'=>$user_id,
                'maker_id'=>Auth::user()->id,
                'post_id'=>$post_id,
                'report_type'=>$this->repo['type'],
                'report_info'=>$this->repo['info'],
            ]);
            $res = Notifyer::store(
                Auth::id(),$user_id,
                'تم تبليغ عن منشورك,الرجاء تعديل او ازالة المنشور',
                $post_id);
        }
        $res == true 
        ? $this->emit('notifi',$this->notis[3]) 
        : $this->emit('notifi',$this->notis[4]);
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
