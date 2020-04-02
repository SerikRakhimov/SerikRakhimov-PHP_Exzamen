<?php

namespace App;

use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    $user = \App\User::on()->first();
    if (!$user) {
        // создать новую запись для админа, если таблица users пуста
        $user = new \App\User();
        $user->name = 'admin';
        $user->email = 'admin@online.kz';
        $user->password = Hash::make('admin');
        $user->admin = 1;
        $user->save();
    }
    if (Auth::check()) {
        return view('welcome');
    } else {
        return redirect()->route('login');
    }
});


Route::get('/order/create', 'OrderController@create')
    ->name('order.create')
    ->middleware('auth');
Route::get('/order/index', 'OrderController@index')
    ->name('order.index')
    ->middleware('auth');
Route::get('/order/{order}', 'OrderController@show')
    ->name('order.show')
    ->middleware('auth');
Route::post('/order/store', 'OrderController@store')
    ->name('order.store')
    ->middleware('auth');
Route::get('/order/{order}/edit', 'OrderController@edit')
    ->name('order.edit')
    ->middleware('auth');
Route::put('/order/{order}', 'OrderController@update')
    ->name('order.update')
    ->middleware('auth');
Route::delete('/order/{order}', 'OrderController@delete')
    ->name('order.delete')
    ->middleware('auth');



Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

