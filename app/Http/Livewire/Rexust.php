<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Requests;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Rexust extends Component
{
    protected $requests;
    protected $listeners = ['changeRequests'];
    public $view = 'sentOffers';
    public function mount()
    {
        $this->getRequsts($this->view);
    }

    public function hydrate()
    {
        $this->getRequsts($this->view);
    }

    public function changeRequests($view)
    {
        $this->view = $view;
        $this->getRequsts($view);
    }

    public function getRequsts($view)
    {
        switch ($view) {
            case 'sentOffers':
                $this->getSentOffers();
                break;
            case 'sentTrades':
                $this->getSentTrades();
                break;
            case 'sentOrders':
                $this->getSentOrders();
                break;
            default:
                $this->getSentOffers();
                break;
        }
        $this->getITems();
        return count($this->requests) > 0 ? $this->requests : [];
    }

    private function getSentOffers()
    {
        return $this->requests = Requests::where([['sender_id','=',Auth::id()],
        ['request_type','=','1']])->get()->sortByDesc('created_at');
    }
    private function getSentTrades()
    {
        return $this->requests = Requests::where([['sender_id','=',Auth::id()],
        ['request_type','=','2']])->get()->sortByDesc('created_at');
    }
    private function getSentOrders()
    {
        return $this->requests = Requests::where([['sender_id','=',Auth::id()],
        ['request_type','=','3']])->get()->sortByDesc('created_at');
    }
    
    private function getITems()
    {
        foreach($this->requests as $key=>$req)
        {
            if($req->status == 1 && $req->created_at->add(3, 'day')->lessThan(Carbon::now())){
                $this->requests->forget($key);
            }
            $req->user = User::find($req->user_id);
            $req->sender = User::find($req->sender_id);
            $req->item = Item::find($req->item_id);
            $req->item->collection = unserialize($req->item->collection);
            if($req->request_type == 1){
                $req->sender_item = Item::find($req->sender_item);
            }
            if($req->request_type == 2 && $req->sender_item != 'trade'){
                $req->sender_item = Item::find($req->sender_item);
            }
        }
        
    }

    public function deleteRequest($id)
    {
        $notis=[['تم حذف الطلب','b','حسنا'],['لم يتم حذف الطلب','r','خطأ']];
        try {
            $req = Requests::find($id);
            $item = Item::find($req->item_id);
            $item->requests -= 1 ;
            $item->save();
            $req->delete();
            $this->emit('notifi',$notis[0]);
        } catch (\Throwable $th) {
            $this->emit('notifi',$notis[1]);
        }finally{
            $this->changeRequests($this->view);
        }
    }

    public function render()
    {
        return view('livewire.rexust',['requests'=>$this->requests]);
    }
}