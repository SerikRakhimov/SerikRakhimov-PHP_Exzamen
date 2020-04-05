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
        return redirect()->route('order.index_job_user');
    } else {
        return redirect()->route('login');
    }
})
    ->name('/');


Route::get('/order/create', 'OrderController@create')
    ->name('order.create')
    ->middleware('auth');

Route::get('/order/index_job_user', 'OrderController@index_job_user')
    ->name('order.index_job_user')
    ->middleware('auth');

Route::get('/order/index_archive_user', 'OrderController@index_archive_user')
    ->name('order.index_archive_user')
    ->middleware('auth');

Route::get('/order/index_job_admin', 'OrderController@index_job_admin')
    ->name('order.index_job_admin')
    ->middleware('auth');

Route::get('/order/index_archive_admin', 'OrderController@index_archive_admin')
    ->name('order.index_archive_admin')
    ->middleware('auth');

Route::get('/order/job_user/{order}', 'OrderController@show_job_user')
    ->name('order.show_job_user')
    ->middleware('auth');

Route::get('/order/archive_user/{order}', 'OrderController@show_archive_user')
    ->name('order.show_archive_user')
    ->middleware('auth');

Route::get('/order/job_admin/{order}', 'OrderController@show_job_admin')
    ->name('order.show_job_admin')
    ->middleware('auth');

Route::get('/order/archive_admin/{order}', 'OrderController@show_archive_admin')
    ->name('order.show_archive_admin')
    ->middleware('auth');

Route::post('/order/store', 'OrderController@store')
    ->name('order.store')
    ->middleware('auth');

Route::get('/order/edit_user/{order}', 'OrderController@edit_user')
    ->name('order.edit_user')
    ->middleware('auth');

Route::get('/order/edit_admin/{order}', 'OrderController@edit_admin')
    ->name('order.edit_admin')
    ->middleware('auth');

Route::put('/order/edit_user/{order}', 'OrderController@update_user')
    ->name('order.update_user')
    ->middleware('auth');

Route::put('/order/edit_admin/{order}', 'OrderController@update_admin')
    ->name('order.update_admin')
    ->middleware('auth');

Route::delete('/order/{order}', 'OrderController@delete')
    ->name('order.delete')
    ->middleware('auth');


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

