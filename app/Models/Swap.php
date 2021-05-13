<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swap extends Model
{
    use HasFactory;
    protected $table ='swaps';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['request_id','user_id','sender_id','item_id','sender_item',];
}
