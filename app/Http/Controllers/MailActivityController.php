<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
// Dependencies Controllers
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\Auth\InheritTeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
// Dependencies Models
use App\Models\ProjectTag;
use App\Models\mail_activity;

class MailActivityController extends Controller
{
    public function getActivityProject(Request $request,$projectId){
        $result = mail_activity::where('project_id',$projectId)->get();
        return $result;
    }

    public function show(Request $request,$token)
    {
        $user = app(UsersController::class)->getUserbyID(Auth::id());
        $project = app(ProjectController::class)->getProjectDetail($token);
        $activity = $this-> getActivityProject($request,$project->id);
        $team = app(InheritTeamController::class)->getTeam($project->team_id);

        return Jetstream::inertia()->render($request, 'Activity/Show', [
            'users' => $user,
            'project' =>$project,
            'activities' => $activity->load('responsible'),
            'team' =>$team->load('owner', 'users'),
        ]);

    }

    public function create(Request $request,$token)
    {
        $user = app(UsersController::class)->getUserbyID(Auth::id());
        $project = app(ProjectController::class)->getProjectDetail($token);
        $activity = $this-> getActivityProject($request,$project->id);
        $team = app(InheritTeamController::class)->getTeam($project->team_id);

        return Jetstream::inertia()->render($request, 'Activity/Create', [
            'users' => $user,
            'project' =>$project,
            'activities' => $activity->load('responsible'),
            'team' =>$team->load('owner', 'users'),
        ]);

    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required'],
            'due_date' => ['required'],
         ]);
         try{
             $data = $request->all();
             $data['access_token']=bin2hex(random_bytes(24));
             mail_activity::create($data);
             return back(303);
         }catch(\Exception $e){
             return abort(500);
         }
    }
 
    public function edit(Request $request,$token)
    {
        $user = app(UsersController::class)->getUserbyID(Auth::id());
        $activity = mail_activity::where('access_token',$token)->firstOrFail();
        $team = app(InheritTeamController::class)->getTeam($user->current_team_id);

        return Jetstream::inertia()->render($request, 'Activity/View', [
            'users' => $user,
            'activity' => $activity->load('responsible','project'),
            'team' =>$team->load('owner', 'users'),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'due_date' => ['required'],
         ]);
         try{
             $data = $request->all();
             $activity = mail_activity::findorfail($request->id);
             $activity->update($data);
             return back(303);
         }catch(\Exception $e){
             return abort(500);
         }
    }

    public function destroy(Request $request, $ActivityId)
    {
        $data = $request->all();
        $activity = mail_activity::find($ActivityId);
        $activity->delete();
        return redirect(config('fortify.home'));
    }
}
