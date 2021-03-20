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
use DB;

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
            $data['progress'] = $this->computePercentace($task->effective_hours,$request->planned_hours);
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

    public function UpdateProgress(Request $request, $taskId, $timesheet){
        $task = ProjectTask::findorfail($taskId);
        echo$task;
        $effective_hours = $task->effective_hours - $timesheet['old_unit_amount'];
        $effective_hours += $timesheet['unit_amount'];
        if ($task->planned_hours > $effective_hours){
            $progress = $this->computePercentace($effective_hours,$task->planned_hours);
            $remaining_hours = 0;
        }
        else{
            $progress = 100;
            $remaining_hours = $effective_hours-$task->planned_hours;
        }
        $task->update([
            'effective_hours'=>$effective_hours,
            'progress'=>$progress,
            'remaining_hours'=>$remaining_hours,
        ]);
    }

    public function computePercentace($part,$total){
        $percentace = round($part/$total * 100);
        return $percentace;
    }

    public function getPlannedAnalysis($ProjectId){
        $query = "to_char(date(created_at),'YYYY-MM') as Month, sum(planned_hours) as time";
        $result = ProjectTask::select(DB::raw($query))->where('project_id',$ProjectId)->groupBy(DB::raw("to_char(date(created_at),'YYYY-MM')"))->get();
        return $result;
    }

    public function getHoursRecorded($ProjectId){
        $query = "project_id, sum(remaining_hours) as overtime, sum(effective_hours) as effective, sum(planned_hours) as planned";
        $result = ProjectTask::select(DB::raw($query))->where('project_id',$ProjectId)->groupBy('project_id')->first();
        return $result;
    }

    public function getTasks($ProjectId){
        $query = "id,name,planned_hours as planned,remaining_hours as remaining,created_at";
        $result = ProjectTask::select(DB::raw($query))->where('project_id',$ProjectId)->get();
        return $result;
    }
}
