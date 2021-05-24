<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB as DB;

class Search extends Component
{
    public $query;
    protected $userId;
    protected $result;

    public function updatedQuery(){
        $quer = str_replace(' ', '', $this->query);
        if( strlen($this->query)>0 ){
            $result = DB::table('indexs')->
                      where('data','like','%' . $this->query . '%')->
                      orderByDesc('created_at')->get()->take(5);
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
                // dd($res);          
            }
            $this->result = $result;
        }else{
            $this->result = [];
        }
    }

    public function render()
    {
        return view('livewire.search',['result'=>$this->result]);
    }
}
