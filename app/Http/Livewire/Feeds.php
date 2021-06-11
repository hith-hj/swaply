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
use Illuminate\Support\Facades\DB as DB;

class Feeds extends Component
{
    protected $feeds;
    protected $listeners = ['getFeeds','refresh'];
    private $g_id = null;
    public $repo;
    public $req_item;
    public $req_info;

    protected $notis = [
        ['تم حفظ المنشور','b','حسنا',],
        ['استلمنا بلاغك سوف نتابع الموضوع ,شكرا لتعاونك','b','حسنا',],
        ['لم يتم ارسال البلاغ,الرجاء ملئ الحقول','r','للاسف',],
    ];

    public function mount()
    {
        $this->getFeeds();
    }

    public function hydrate()
    {
        $this->getFeeds();
    }

    public function refresh()
    {
        $this->getFeeds();
    }

    public function getFeeds()
    {
        $requests = Requests::where('sender_id','=',Auth::user()->id)->orWhere('user_id','=',Auth::user()->id)->get();
        $this->feeds = Item::all()->where('status','=','0')->sortBy('views',0,true);
        $requests = count($requests) > 0  ? $requests : false ;
        foreach($this->feeds as $key=>$feed)
        {
            if($requests != false)
            {
                foreach($requests as $req)
                {
                    if($feed->id == $req->item_id || $feed->id == $req->sender_item){
                        $this->feeds->forget($key);
                    }
                }
            }
        }
        $this->feeds->each(function($feed){
            $feed->user = User::find($feed->user_id);
            $feed->collection = unserialize($feed->collection);
            $feed->user_items = Item::where([
                ['user_id','=',Auth::id()],
                ['status','=','0'],
                ['item_type','!=','3'],
                ])->get();
        });
    }

    public function savePost($postId,$user_id)
    {
        $res = Notifyer::store(Auth::id(),$user_id,'تم حفظ المنشور ',$postId);
        $sa = new Save();
        $sa->user_id = Auth::id();
        $sa->post_id = $postId;
        $sa->save();
        $this->emit('notifi',$this->notis[0]);
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
        ? $this->emit('notifi',$this->notis[1]) 
        : $this->emit('notifi',$this->notis[2]);
        
    }

    public function resetReport()
    {
        $this->report_type = '';
        $this->report_info = '';
    }

    public function render()
    {
        return view('livewire.feeds',['feeds'=>$this->feeds]);
    }
}
 