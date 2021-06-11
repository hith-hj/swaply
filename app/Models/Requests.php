<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;
    protected $table ='requests';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['user_id','item_id','request_type','sender_id','sender_item','status','viewed',];
}
