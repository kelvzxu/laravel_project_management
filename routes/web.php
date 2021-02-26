<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\InheritTeamController;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserFriendController;

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
    return view('index');
});
Route::group(['middleware' => 'auth'], function (){
    Route::get('auth/github', [GithubController::class, 'redirectToGithub']);
    Route::get('auth/github/callback', [GithubController::class, 'handleGithubCallback']);
    Route::get('/{user}', [ProfileController::class, 'PublicProfile'])
                        ->name('profile.public');
    Route::get('/user/sessions', [ProfileController::class, 'session'])
                        ->name('profile.session');
    Route::get('/user/password', [ProfileController::class, 'updatePassword'])
                        ->name('profile.password');
    Route::get('/user/preferences', [ProfileController::class, 'preference'])
                        ->name('profile.preferences');
    Route::get('/user/team/all/{user}', [InheritTeamController::class, 'getMyTeams'])
                        ->name('team.myteam');
    Route::get('/search/{user}', [SearchController::class, 'Search'])
                        ->name('user.search');
    Route::post('/user/follow',[UserFriendController::class,'FollowUser'])
                        ->name('user.follow'); 
    Route::post('/user/unfollow',[UserFriendController::class,'UnfollowUser'])
                        ->name('user.unfollow'); 
    Route::post('/join/teams/{team}/members', [InheritTeamController::class, 'Join'])->name('team.join');
    Route::get('/teams/{team}', [InheritTeamController::class, 'show'])->name('teams.show');
});  


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/timesheet', function () {
    return Inertia\Inertia::render('Timesheet');
})->name('timesheet');

