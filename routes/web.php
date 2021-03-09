<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\InheritTeamController;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserFriendController;
// Project Module
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\ProjectTaskTypeController;
use App\Http\Controllers\IrAttachmentController;

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
Route::get('auth/github', [GithubController::class, 'redirectToGithub']);
Route::get('auth/github/callback', [GithubController::class, 'handleGithubCallback']);
Route::group(['middleware' => 'auth'], function (){
    Route::get('/dashboard', [PageController::class, 'Dashboard'])->name('dashboard');
    Route::get('/user/profile', [ProfileController::class, 'show'])
                    ->name('profile.show');
    Route::get('/{user}/view/', [ProfileController::class, 'PublicProfile'])
                        ->name('profile.public');
    Route::get('/{user}/followers', [ProfileController::class, 'Followers'])
                        ->name('profile.followers');
    Route::get('/{user}/following', [ProfileController::class, 'Following'])
                        ->name('profile.following');
    Route::get('/user/sessions', [ProfileController::class, 'session'])
                        ->name('profile.session');
    Route::get('/user/password', [ProfileController::class, 'updatePassword'])
                        ->name('profile.password');
    Route::get('/user/preferences', [ProfileController::class, 'preference'])
                        ->name('profile.preferences');
    Route::get('/user/team/all/', [InheritTeamController::class, 'getMyTeams'])
                        ->name('team.myteam');
    Route::get('/{user}/team/all/', [InheritTeamController::class, 'getTeams'])
                        ->name('profile.teams');
    Route::get('/search/{user}', [PageController::class, 'Search'])
                        ->name('user.search');
    Route::post('/user/follow',[UserFriendController::class,'FollowUser'])
                        ->name('user.follow'); 
    Route::post('/user/unfollow',[UserFriendController::class,'UnfollowUser'])
                        ->name('user.unfollow'); 
    Route::post('/join/teams/{team}/members', [InheritTeamController::class, 'Join'])
                        ->name('team.join');
    Route::get('/teams/{team}', [InheritTeamController::class, 'show'])
                        ->name('teams.show');
    Route::post('/project', [ProjectController::class, 'store'])
                        ->name('project.store');
    Route::get('/project/{project}', [ProjectController::class, 'show'])
                        ->name('project.show');
    Route::get('/project/view/{project}', [ProjectController::class, 'view'])
                        ->name('project.detail');
    Route::get('/project/{project}/task', [ProjectTaskController::class, 'getTaskProject'])
                        ->name('project_task.show');
    Route::get('/project/{project}/task/type', [ProjectController::class, 'getProjectDetail'])
                        ->name('project_task_type.show');
    Route::post('/project/task/updatestage', [ProjectTaskController::class, 'UpdateStage'])
                        ->name('task_stage.update');
    Route::post('/attachment/store', [IrAttachmentController::class, 'store'])
                        ->name('attachment.store');
    Route::post('/teams', [InheritTeamController::class, 'store'])->name('teams.store');
                        
});  


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia\Inertia::render('Dashboard');
// })->name('dashboard');

