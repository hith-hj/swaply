<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchResult extends Component
{
    protected $result;
    public $query;

    public function mount($query)
    {
        $this->query = $query;
        $this->getResult();
    }

    public function getResult()
    {
        if( strlen($this->query)>0 ){
            $result = DB::table('indexs')->
                      where('data','like','%' . $this->query . '%')->
                      orderByDesc('created_at')->get();
            foreach($result as $res)
            {
                $post = Item::find($res->item_id);
                if ($post !== null)
                {
                    $res->info  = $post;
                    $res->info->collection = unserialize($res->info->collection);
                }else{
                    $res->info = 'deleted';
                }          
            }
            $this->result = $result;
        }else{
            $this->result = [];
        }
        // dd($this->result);
    }

    public function render()
    {
        return view('livewire.search-result',['result'=>$this->result]);
    }
}
