<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table ='items';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['user_id','item_type','item_title','item_info','collection',
                        'item_location','views','offers','status','swap_with','directory',];

    public static function incRequests(String $id):bool
    {
        $it = self::find($id);
        $it->requests +=1;
        $it->save();
        return $it == true ? true : false;
    }
    
    public static function incViews(String $id):bool
    {
        $it = self::find($id);
        $it->views +=1;
        $it->save();
        return $it == true ? true : false;
    }
}
