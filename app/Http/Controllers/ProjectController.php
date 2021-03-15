<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\Auth\InheritTeamController;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
use App\Models\Project;

class ProjectController extends Controller
{
    public function Store(Request $request){
        try{
            $data=$request->all();
            $data['access_token']=bin2hex(random_bytes(24));
            Project::create($data);
            return back(303);
        }catch(\Exception $e){
            echo"$e";
        }
    }

    public function show(Request $request,$projectId){
        $user = app(UsersController::class)->getUserbyID(Auth::id());
        $response = $this-> getProjectDetail($projectId);
        $team = app(InheritTeamController::class)->getTeam($response->team_id);
        return Jetstream::inertia()->render($request, 'Project/Show', [
            'users' => $user,
            'team' =>$team->load('owner', 'users'),
            'project' =>$response
        ]);
    }

    public function view(Request $request,$projectId){
        try{

            $user = app(UsersController::class)->getUserbyID(Auth::id());
            $response = $this-> getProjectDetail($projectId);
            $team = app(InheritTeamController::class)->getTeam($response->team_id);
            return Jetstream::inertia()->render($request, 'Project/View', [
                'users' => $user,
                'team' =>$team->load('owner', 'users'),
                'project' =>$response
            ]);
        }catch(\Exception $e){
            return abort(404);
        }
    }

    public function getTeamProject($teamId){
        $response = Project::with('manager')->where('team_id','=',$teamId)->get();
        return $response;
    }

    public function getProjectDetail($token){
        $result = Project::with('task_type','task_type.tasks','task_type.tasks.tags','manager','team','task')->where('access_token','=',$token)->first();
        return $result;
    }

    public function update(Request $request){
        $project = Project::findOrFail($request->id);
        $project->update($request->all());
        return back(303);
    }
}
