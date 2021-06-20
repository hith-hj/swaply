<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Save;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Saves extends Component
{
    public $saves;
    public function mount()
    {
        $this->getSaves();
    }

    public function getSaves()
    {
        $this->saves = Save::all()->where('user_id',Auth::id())->sortByDesc('created_at');
        foreach($this->saves as $sv)
        {
            $sv->item = Item::find($sv->post_id);
            $sv->item->collection = unserialize($sv->item->collection);
        }
    }

    public function deleteSave($save_id)
    {
        $sv = Save::find($save_id);
        if(isset($sv)){
            $sv->delete();
            $noti = ['تم الحذف','r','حسنا'];
            $this->emit('notifi',$noti);
        }
        $this->getSaves();
    }

    public function render()
    {
        return view('livewire.saves');
    }
}
