<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTaskType;
use App\Models\ProjectTaskTypeRel;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\Auth\InheritTeamController;
use App\Http\Controllers\ProjectController;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;

class ProjectTaskTypeController extends Controller
{
     public function show(Request $request,$token){
        $user = app(UsersController::class)->getUserbyID(Auth::id());
        $project = app(ProjectController::class)->getProjectDetail($token);
        $team = app(InheritTeamController::class)->getTeam($project->team_id);

        return Jetstream::inertia()->render($request, 'Stage/Show', [
            'users' => $user,
            'project' =>$project,
            'team' =>$team->load('owner', 'users'),
        ]);
     }

     public function store(Request $request){
        $data = $request->all();
        $stage = ProjectTaskType::create($data);
        $data['project_task_type_id'] = $stage->id;
        $stage_rel = ProjectTaskTypeRel::create($data);
        return back(303);
     }


}
