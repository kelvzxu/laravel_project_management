<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\InheritTeamController;

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
Route::get('/user/sessions', [ProfileController::class, 'session'])
                    ->name('profile.session');
Route::get('/user/password', [ProfileController::class, 'updatePassword'])
                    ->name('profile.password');
Route::get('/user/preferences', [ProfileController::class, 'preference'])
                    ->name('profile.preferences');
Route::get('/user/team/all/{user}', [InheritTeamController::class, 'getMyTeams'])
                    ->name('team.myteam');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/project', function () {
    return Inertia\Inertia::render('Project');
})->name('project');
Route::middleware(['auth:sanctum', 'verified'])->get('/timesheet', function () {
    return Inertia\Inertia::render('Timesheet');
})->name('timesheet');

