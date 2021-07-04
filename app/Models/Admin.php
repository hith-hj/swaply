<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Admin extends Model
{
    use HasFactory;

    protected static function isAdmin()
    {
        return self::where('user_id','=',Auth::id())->exists();
    }

    protected static function getAdmin()
    {
        return self::where('user_id','=',Auth::id())->first();
    }
}
