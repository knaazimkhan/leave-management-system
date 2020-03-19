<?php

use App\User;
use App\LeaveBalance;

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
    // $comment = LeaveBalance::find(15);
    // return $comment->user;
    // $user = User::where('id', '<>', 1)->with('balance')->get();
    // return User::find(3);
    // return $balance = balance;   
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/leave/index', 'LeaveApplyController@index')->name('leave.index');
Route::post('/leave/store', 'LeaveApplyController@store')->name('leave.store');

Route::prefix('admin')->middleware(['auth','auth.admin'])->group( function () {
    Route::get('/home', 'AdminController@index')->name('admin.home');
    Route::get('/approve', 'AdminController@approve')->name('admin.approve');
    Route::get('/reject', 'AdminController@reject')->name('admin.reject');
});
