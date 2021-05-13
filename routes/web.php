<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Showitem;
use App\Http\Livewire\Body;


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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Route::post('/addItem','HomeController@addItem')->name('addItem');
Route::post('/addItem',[HomeController::class,'addItem'])->name('addItem');
Route::get('/item/show/&{id}&/HtybVertnXAsdR',function($id){
    // dd($id);
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
// Route::get('/item/show/&{id}',[Body::class,'viewItem']);

Route::get('/show/{id}', Showitem::class
    // return view('livewire.showitem',['g_id',$id])->extends('layouts.sapp')->section('content');
);

