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
            'task' => $task->load('team','team.users','responsible','stage','project','project.task_type'),
        ]);
    }
}
