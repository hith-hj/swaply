<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekia extends Model
{
    use HasFactory;
    protected $fillable=['user_id','pekia_title','pekia_location','pekia_coordinates','pekia_price'
    ,'collecion','directory','status','swaply_price','swaply_msg','pickup_date'];
}
