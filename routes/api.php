<?php

use App\User;
use App\LeaveBalance;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersCollection;
use App\Http\Resources\LeaveBalanceCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/users/{user}', function(User $user) {
    // dd($id);
    return new UserResource($user);
});

Route::get('/users', function() {
    $user = User::where('id', '<>', 1)->with(['balance', 'apply'])->get();
    return new UsersCollection($user);
});
