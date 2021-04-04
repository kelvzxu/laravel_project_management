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
use App\Models\ProjectTask;
use App\Models\ProjectTaskType;
use App\Models\ProjectTaskTypeRel;

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

     public function upgrade(Request $request){
         $data = $request->all();
         $stage = ProjectTaskType::findOrFail($request->id);
         $stage->update($data);
         return back(303);
     }

     public function destroy(Request $request,$StageId){
         $this->RemoveRelationsTaskRel($request,$StageId);
         $this->RemoveRelationsTask($request,$StageId);
         $data = $request->all();
         $stage = ProjectTaskType::findOrFail($StageId);
         $stage->delete();
         return back(303);
     }

     public function RemoveRelationsTaskRel(Request $request,$StageId){
        $stage_rels = ProjectTaskTypeRel::where('project_task_type_id',$StageId)->get();
        foreach($stage_rels as $e => $data){
            $data->delete();
        }
     }
     public function RemoveRelationsTask(Request $request,$StageId){
        $task = ProjectTask::where('stage_id',$StageId)->get();
        foreach($task as $e => $data){
            $data->delete();
        }
     }
     
     public function checkCloseState($StageId){
        $result = ProjectTaskType::find($StageId);
        return $result->is_closed;
     }

}
