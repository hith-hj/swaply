<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indexs extends Model
{
    use HasFactory;

    protected $table ='indexs';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['item_id','data',];

    public static function store(string $item_id,string $data):bool{

        $tim = self::create([
            'item_id'=>$item_id,
            'data'=>$data,
        ]);

        return $tim == true ? true : false;
    }
}
