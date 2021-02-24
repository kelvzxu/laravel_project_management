<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\InheritTeamController;
use App\Http\Controllers\Auth\UsersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/team/fetch/{user}', [InheritTeamController::class, 'fetchTeams'])
                    ->name('fetch.teams');
Route::get('/user/fetch/{user}', [UsersController::class, 'fetchUser'])
                    ->name('fetch.user');
