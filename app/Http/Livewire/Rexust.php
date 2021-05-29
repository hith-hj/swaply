<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Requests;
use App\Models\User;
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
            case 'recivedOffers':
                $this->getRecivedOffers();
                break;
            case 'sentOrders':
                $this->getSentOrders();
                break;
            case 'recivedOrders':
                $this->getRecivedOrders();
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
        return $this->requests = Requests::where([['sender_id','=',Auth::id()],['item_type','=',1]])->get();
    }
    private function getRecivedOffers()
    {
        return $this->requests = Requests::where([['user_id','=',Auth::id()],['item_type','=',1]])->get();
    }
    private function getSentOrders()
    {
        return $this->requests = Requests::where([['sender_id','=',Auth::id()],['item_type','=',2]])->get();
    }
    private function getRecivedOrders()
    {
        return $this->requests = Requests::where([['user_id','=',Auth::id()],['item_type','=',2]])->get();
    }
    
    private function getITems()
    {
        foreach($this->requests as $req)
        {
            $req->user = User::find($req->user_id);
            $req->sender = User::find($req->sender_id);
            $req->item = Item::find($req->item_id);
            $req->item->collection = unserialize($req->item->collection);
            if($req->item_type == 1){
                $req->sender_item = Item::find($req->sender_item);
            }        
        }
        return $this->requests->sortByDesc('created_at');
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