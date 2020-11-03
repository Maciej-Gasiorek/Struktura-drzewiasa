<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/trees');
});

Route::resource('/trees','App\Http\Controllers\TreeController')->except(['show']);

// Thanks to above , resource clause , all methods from controller are available 
// automatically , without show method because this method does not exist in this program.

Route::get("/trees/createChildren/{id}",'App\Http\Controllers\TreeController@createChildren')->name('trees.createChildren');

Route::get("/trees/destroy/{id}",'App\Http\Controllers\TreeController@deleteForm')->name('trees.deleteForm');

