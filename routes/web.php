<?php

use Illuminate\Support\Facades\Route;
// Thirty Apps Login
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\LinkedinController;
use App\Http\Controllers\Auth\TwitterController;
// Inheritance
use Laravel\Jetstream\Http\Controllers\Inertia\TeamMemberController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\InheritTeamController;
use App\Http\Controllers\Auth\InheritTeamMemberController;
use App\Http\Controllers\Auth\UsersController;
// Project Module
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserFriendController;
use App\Http\Controllers\RequestJoinController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\ProjectTaskTypeController;
use App\Http\Controllers\IrAttachmentController;
use App\Http\Controllers\AccountAnalyticLineController;
use App\Http\Controllers\ProjectTagController;
use App\Http\Controllers\MailActivityController;
use App\Http\Controllers\ReportController;

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
})->name('landing');

Route::group(['prefix'=>'auth/github'],function(){
        Route::get('/', [GithubController::class, 'redirectToGithub']);
        Route::get('/callback', [GithubController::class, 'handleGithubCallback']);
});

Route::group(['prefix'=>'auth/linkedin'],function(){
        Route::get('/', [LinkedinController::class, 'redirectToLinkedin']);
        Route::get('/callback', [LinkedinController::class, 'handleLinkedinCallback']);
});

Route::group(['prefix'=>'auth/twitter'],function(){
        Route::get('/', [TwitterController::class, 'redirectToTwitter']);
        Route::get('/callback', [TwitterController::class, 'handleTwitterCallback']);
});

Route::group(['middleware' => 'auth','middleware' => 'verified'], function (){
    Route::group(['prefix'=>'user'],function(){      
        Route::get('/profile', [ProfileController::class, 'show'])
                ->name('profile.show');
        Route::get('/sessions', [ProfileController::class, 'session'])
                ->name('profile.session');
        Route::get('/password', [ProfileController::class, 'updatePassword'])
                ->name('profile.password');
        Route::get('/preferences', [ProfileController::class, 'preference'])
                ->name('profile.preferences');
        Route::get('/team/all/', [InheritTeamController::class, 'getMyTeams'])
                ->name('team.myteam');
        Route::post('/follow',[UserFriendController::class,'FollowUser'])
                ->name('user.follow'); 
        Route::post('/unfollow',[UserFriendController::class,'UnfollowUser'])
                ->name('user.unfollow'); 
    });
    Route::group(['prefix'=>'teams'],function(){  
        //  InheritTeamController
        Route::get('/{team}', [InheritTeamController::class, 'show'])
                ->name('teams.show');
        Route::get('/project/{project}', [InheritTeamController::class, 'getProject'])
                ->name('teams.project');
        Route::post('/join/{team}/members', [InheritTeamController::class, 'Join'])
                        ->name('team.join');
        Route::post('/store', [InheritTeamController::class, 'store'])
                ->name('teams.store');
        Route::put('/teams/{team}', [InheritTeamController::class, 'update'])
                ->name('teams.update');
        // RequestJoinController
        Route::post('/{team}/approve/{user}', [RequestJoinController::class, 'Approve'])
                ->name('request_join.approve');   
        Route::delete('/{team}/request/{user}', [RequestJoinController::class, 'destroy'])
                ->name('request_join.destroy');   
        // Page Controller
        Route::get('/{team}/request', [PageController::class, 'RequestJoin'])
                ->name('request_join.show');     
        // Team Member Controller
        Route::delete('/{team}/members/{user}', [TeamMemberController::class, 'destroy'])
                ->name('team-members.destroy');
        Route::post('/teams/{team}/members', [InheritTeamMemberController::class, 'store'])
                ->name('team-members.store');
    });
    Route::group(['prefix'=>'project'],function(){  
        Route::get('/{project}', [ProjectController::class, 'show'])
        ->name('project.show');
        Route::get('/view/{project}', [ProjectController::class, 'view'])
        ->name('project.detail');
        Route::post('', [ProjectController::class, 'store'])
        ->name('project.store');
        Route::post('/update', [ProjectController::class, 'update'])
        ->name('project.update');   
        Route::delete('/archive/{project}', [ProjectController::class, 'archive'])
        ->name('project.archive');  
        Route::post('/AddParicipants/{project}', [ProjectController::class, 'StoreProjectUsers'])
        ->name('project.newuser'); 
        Route::delete('/destroy/{project}', [ProjectController::class, 'destroyParticipants'])
        ->name('project_user.destroy');    
    });
    Route::group(['prefix'=>'project/task'],function(){  
        Route::get('/{project}', [ProjectTaskController::class, 'getTaskProject'])
        ->name('project_task.show');
        Route::get('/view/{task}', [ProjectTaskController::class, 'view'])
        ->name('project_task.view');    
        Route::post('/updatestage', [ProjectTaskController::class, 'UpdateStage'])
        ->name('task_stage.update');
        Route::post('/store', [ProjectTaskController::class, 'store'])
        ->name('project_task.store');    
        Route::delete('/destroy/{task}', [ProjectTaskController::class, 'destroy'])
        ->name('project_task.destroy');                     
    });
     Route::group(['prefix'=>'project/tags'],function(){  
        Route::get('/{project}', [ProjectTagController::class, 'show'])
        ->name('tags.show');  
        Route::post('/store', [ProjectTagController::class, 'store'])
        ->name('tags.store'); 
        Route::post('/upgrade', [ProjectTagController::class, 'update'])
        ->name('tags.update'); 
        Route::delete('/destroy/{tags}', [ProjectTagController::class, 'destroy'])
        ->name('tags.destroy');                      
    });
    Route::group(['prefix'=>'project/activity'],function(){
        Route::get('/{project}', [MailActivityController::class, 'show'])
        ->name('activity.show');
        Route::get('/create/{project}', [MailActivityController::class, 'create'])
        ->name('activity.create'); 
        Route::get('/views/{project}', [MailActivityController::class, 'edit'])
        ->name('activity.edit'); 
        Route::post('/store', [MailActivityController::class, 'store'])
        ->name('activity.store'); 
        Route::post('/upgrade', [MailActivityController::class, 'update'])
        ->name('activity.update'); 
        Route::delete('/destroy/{activity}', [MailActivityController::class, 'destroy'])
        ->name('activity.destroy');  

    });
    Route::group(['prefix'=>'project/accountanalyticline'],function(){ 
        Route::get('/{project}', [PageController::class, 'Timesheet'])
                            ->name('timesheet.show');
        Route::post('/store', [AccountAnalyticLineController::class, 'store'])
                            ->name('timesheet.store');
         Route::post('/update', [AccountAnalyticLineController::class, 'update'])
                            ->name('timesheet.update');
        Route::delete('/destroy/{timesheet}', [AccountAnalyticLineController::class, 'destroy'])
                            ->name('timesheet.destroy');
    });
    Route::group(['prefix'=>'{user}'],function(){ 
        Route::get('/view', [ProfileController::class, 'PublicProfile'])
                            ->name('profile.public');
        Route::get('/followers', [ProfileController::class, 'Followers'])
                            ->name('profile.followers');
        Route::get('/following', [ProfileController::class, 'Following'])
                            ->name('profile.following');
        Route::get('/team/all/', [InheritTeamController::class, 'getTeams'])
                            ->name('profile.teams');
        Route::get('/contribute/Projects', [ProfileController::class, 'getProjects'])
                            ->name('profile.projects');
    });
     Route::group(['prefix'=>'project/stage'],function(){ 
        Route::get('/{project}', [ProjectTaskTypeController::class, 'show'])
                                ->name('stage.show');
        Route::post('/store', [ProjectTaskTypeController::class, 'store'])
                                ->name('stage.store');
        Route::post('/update', [ProjectTaskTypeController::class, 'upgrade'])
                                ->name('stage.update');
        Route::delete('/destroy/{stage}', [ProjectTaskTypeController::class, 'destroy'])
                                ->name('stage.destroy');
    });
    Route::group(['prefix'=>'project/Report'],function(){ 
        Route::get('/{project}/overview', [ReportController::class, 'OverviewReport'])
                                ->name('report.overview');
        Route::get('/{project}/Task/AnalysisReport', [ReportController::class, 'TaskAnalysisReport'])
                                ->name('report.task_analysis');
        Route::get('/{project}/PlanningTimesheet/AnalysisReport', [ReportController::class, 'TimesheetPlanningAnalysisReport'])
                                ->name('report.planning_analysis');
        Route::get('/{project}/ProjectCost', [ReportController::class, 'ProjectCostReport'])
                                ->name('report.cost');
    });
    Route::get('/dashboard', [PageController::class, 'Dashboard'])->name('dashboard');
    Route::get('/search/{user}', [PageController::class, 'Search'])
                        ->name('user.search');
    Route::post('/attachment/store', [IrAttachmentController::class, 'store'])
                        ->name('attachment.store');
});  

Route::get('test',[ProjectTaskController::class, 'notification']);


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia\Inertia::render('Dashboard');
// })->name('dashboard');

