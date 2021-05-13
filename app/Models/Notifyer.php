<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Notifyer extends Model
{
    use HasFactory;
    
    protected $table ='notifications';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['user_id','maker_id','data','on_id','status',];

    public static function store(string $maker_id ,string $user_id , string $data , string $on_id) : bool{
        // dd( $maker_id , $user_id ,  $data ,  $on_id);
        self::create([
            'user_id'=>$user_id,
            'maker_id'=>$maker_id,
            'on_id'=>$on_id,
            'data'=>$data,
        ]);        
        return true;
    }

    public static function getNotifications($id)
    {
        return self::where([
            ['user_id','=',$id],
            ['status','=',0],
            ])->get()->sortByDesc('created_at');
    }
}
