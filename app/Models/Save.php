<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    use HasFactory;

    protected $table ='saves';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['user_id','post_id'];
}
