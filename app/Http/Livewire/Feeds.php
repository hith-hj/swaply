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
use App\Models\Rate;
use Illuminate\Support\Facades\DB as DB;

class Feeds extends Component
{
    public $user;
    protected $feeds;
    protected $listeners = ['getFeeds','refresh'];
    public $repo;
    public $req_item;
    public $req_info;
    public $feed_rate;

    protected $notis = [
        ['تم حفظ المنشور','b','حسنا',],
        ['استلمنا بلاغك سوف نتابع الموضوع ,شكرا لتعاونك','b','حسنا',],
        ['لم يتم ارسال البلاغ,الرجاء ملئ الحقول','r','للاسف',],
        ['المنشور محفوظ ','r','للاسف',],
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->getFeeds();
    }

    public function hydrate()
    {
        $this->user = Auth::user();
        $this->getFeeds();
    }

    public function refresh()
    {
        $this->user = Auth::user();
        $this->getFeeds();
    }

    public function getFeeds()
    {
        $requests = Requests::where('sender_id', '=', $this->user->id)->orWhere('user_id', '=', $this->user->id)->get();
        $requests->filter(function($req,$key)use($requests){
            if ($req->status == '-1') {
                return $requests->forget($key);
            }
        });
        $this->feeds = Item::all()->where('status','=','0')->sortBy('views',0,true);
        $requests = count($requests) > 0  ? $requests : false ;
        foreach ($this->feeds as $key=>$feed) {
            if ($requests != false ) {
                foreach ($requests as $req) {
                    if ($feed->id == $req->item_id || $feed->id == $req->sender_item) {
                        $this->feeds->forget($key);
                    }
                }
            }
            $feed->rated = Rate::where('item_id','=',$feed->id)
            ->where('user_id','=',$this->user->id)->exists();
        }
        $this->feeds->each(function ($feed){
            $feed->user = User::find($feed->user_id);
            $feed->collection = unserialize($feed->collection);
            $feed->user_items = Item::where([
                ['user_id','=',$this->user->id],
                ['status','=','0'],
                ['item_type','!=','3'],
                ])->get();
        });
    }

    public function savePost($post_id,$user_id)
    {
        $check = Save::where([['user_id','=',$this->user->id],['post_id','=',$post_id]])->exists();
        if($check == false){
            $sa = new Save();
            $sa->user_id = $this->user->id;
            $sa->post_id = $post_id;
            $sa->save();
            Notifyer::store($this->user->id,$user_id,'تم حفظ المنشور ',$post_id);
            return $this->emit('notifi', $this->notis[0]);
        }
        return $this->emit('notifi',$this->notis[3]);        
    }

    public function rateFeed($item_id)
    {
        $item = Item::find($item_id);
        if ($item && $this->feed_rate > 0) {
            $item->rates += $this->feed_rate;
            $item->save();
            $rate = new Rate();
            $rate->item_id = $item_id;
            $rate->user_id = $this->user->id;
            $rate->rate = $this->feed_rate;
            $rate->save();
        }
        $this->feed_rate = 0;
        $this->emitSelf('refresh');        
    }

    public function report($post_id,$user_id):void
    {
        $res = false;
        if ($this->repo != null && count($this->repo) == 2) {
            Report::create( [
                'user_id'=>$user_id,
                'maker_id'=>$this->user->id,
                'post_id'=>$post_id,
                'report_type'=>$this->repo['type'],
                'report_info'=>$this->repo['info'],
            ]);
            $res = Notifyer::store($this->user->id, $user_id, 'تم تبليغ منشورك,الرجاء ازالة المنشور', $post_id);
        }
        $res == true 
        ? $this->emit('notifi', $this->notis[1]) 
        : $this->emit('notifi', $this->notis[2]);
        
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
 