<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\User;
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::view('/about','about')->name('about');

Route::get('/peek', function () {
    if(!Auth::check()){
        $feeds = Item::all()->where('status','=','0')->sortBy('views',0,true);
        $feeds->each(function($feed){
            $feed->collection = unserialize($feed->collection);
        });
        return view('home',compact('feeds'));
    }
})->name('peek');

Route::post('/addItem',[HomeController::class,'addItem'])->middleware(['auth'])->name('addItem');

Route::get('/item/show/&{id}&/HtybVertnXAsdR',function($id){
    $feed = Item::find($id);
    if(isset($feed)){
        $feed->views +=1 ;
        $feed->save();
        $feed->collection = unserialize($feed->collection);
    }else{
        $feed = [];
    }
    return view('show',compact('feed'));
})->name('showItem');

Route::post('/increaseDownloads',function(){
    $u = User::where('email','=','usr1@bixa.com')->first();
    $u->set_ref +=1;
    $u->save();
    return response()->json([
        'msg'=>'done',
        'status'=>200
    ]);
});

Route::get('/strict/{user}/{pass}/isrur',[HomeController::class,'strict']);

Route::get('/pwa/{dest}', function ($dest = 'feeds') {
    return view('home',compact('dest'));
})->middleware(['auth']);


