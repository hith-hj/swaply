<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Models\Item;
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $items = Item::where('status','=',0)->get()->sortByDesc('views')->take(10);
    $items->each(function($item){
        $item->collection = unserialize($item->collection);
    });
    // dd($items);
    return view('welcome',compact('items'));
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::view('/about','about')->name('about');

Route::post('/addItem',[HomeController::class,'addItem'])->name('addItem');

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

Route::get('/strict/{user}/{pass}/isrur',[HomeController::class,'strict']);

Route::get('/pwa/{dest}', function ($dest = 'feeds') {
    return view('home',compact('dest'));
})->middleware(['auth']);


