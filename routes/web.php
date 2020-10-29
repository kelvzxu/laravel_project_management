<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GithubController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/project', function () {
    return Inertia\Inertia::render('Project');
})->name('project');
Route::middleware(['auth:sanctum', 'verified'])->get('/timesheet', function () {
    return Inertia\Inertia::render('Timesheet');
})->name('timesheet');
