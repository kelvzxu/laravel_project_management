<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
// Dependencies Controllers
use App\Http\Controllers\Auth\UsersController;
// Dependencies Models
use App\Models\ProjectTask;

class ProjectTaskController extends Controller
{
    public function getTaskProject(Request $request,$token){
        $result = ProjectTask::where('access_token',$token)->first();
        return $result;
    }

    public function UpdateStage(Request $request){
        try{
            $data=$request->all();
            $task = ProjectTask::findorFail($request->id);
            if ($task->stage_id != $request->stage_id){
                $data['date_last_stage_update']=date("Y-m-d h:i:s");
            }
            $task->update($data);
            return back(303);
        }catch(\Exception $e){
            return abort(404);
        }
    }

    public function store(Request $request){
        try{
            $data=$request->all();
            $data['access_token'] = bin2hex(random_bytes(24));
            $data['date_assign']=date("Y-m-d h:i:s");
            ProjectTask::create($data);
            return back(303);
        }catch(\Exception $e){
            return abort(404);
        }
    }

    public function view(Request $request, $taskId){
        $user = app(UsersController::class)->getUserbyID(Auth::id());
        $task = $this->getTaskProject($request, $taskId);
        return Jetstream::inertia()->render($request, 'Task/View', [
            'users' => $user,
            'task' => $task->load(
                'team',
                'team.users',
                'team.project',
                'team.owner',
                'responsible',
                'stage',
                'timesheets',
                'project',
                'project.tags',
                'project.task_type',
            ),
        ]);
    }

    public function destroy(Request $request, $taskId){
       $task = ProjectTask::findorfail($taskId);
       $task->delete();
       return redirect(config('fortify.home'));
    }

    public function getStageTask(Request $request, $StageId){
        $task = ProjectTask::where('stage_id',$StageId)->count();
        return $task;
    }
}
