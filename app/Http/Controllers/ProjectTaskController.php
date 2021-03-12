<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTask;

class ProjectTaskController extends Controller
{
    public function getTaskProject(Request $request,$projectId){
        $result = ProjectTask::get();
        return $result;
    }

    public function UpdateStage(Request $request){
        try{
            $data=$request->all();
            $task = ProjectTask::findorFail($request->id);
            $task->update($data);
            return back(303);
        }catch(\Exception $e){
            echo"$e";
        }
    }

    public function store(Request $request){
        try{
            echo $request;
            $data=$request->all();
            ProjectTask::create($data);
            return back(303);
        }catch(\Exception $e){
            echo"$e";
        }
    }

    public function view(Request $request, $taskId){
        echo"Hello";
        echo"<br>";
        echo $taskId;
    }
}
