<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table ='reports';
    protected $primarykey='id';
    public $timestamp='true';
    protected $fillable=['user_id','maker_id','post_id','report_info','report_type',];
}
