<?php

namespace App\Http\Livewire;

use App\Models\Pekia;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Pekias extends Component
{
    public $pekias;


    public function mount()
    {
        $this->getPekia();
    }

    public function hydrate()
    {
        $this->getPekia();
    }

    public function getPekia()
    {
        $this->pekias = Pekia::where('user_id','=',Auth::id())->get()->sortByDesc('created_at');
        $this->pekias->each(function($pekia){
            $pekia->collection = unserialize($pekia->collection);
        });
    }

    public function deletePekia($pekia_id)
    {
        $pekia = Pekia::find($pekia_id);
        $notis = [['الطلب محذوف اوغير موجود','r','خطأ'],['تم حذف طلب سوابيكيا','b','حسنا']];
        if($pekia){
            $pekia->delete();            
            $this->emit('notifi',$notis[1]);
        }else{
            $this->emit('notifi',$notis[0]);
        }
        return $this->getPekia();
    }

    public function render()
    {
        return view('livewire.pekias');
    }
}
