<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountAnalyticLine;
use App\Http\Controllers\ProjectTaskController;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use DB;

class AccountAnalyticLineController extends Controller
{
    public function fetchAnalyticLine (Request $request,$ProjectId){
       $project = app(ProjectController::class)->getProjectById($ProjectId);
       $manager = $project->user_id;
       if ($manager == Auth::id()){
           $result = AccountAnalyticLine::where("project_id",$ProjectId)->orderByDESC('updated_at')->get();
       }
       else{
        $result = AccountAnalyticLine::where("project_id",$ProjectId)->where('user_id',Auth::id())->orderByDESC('updated_at')->get();
       }
       return $result;
    }

    public function store (Request $request){
        $request->validate([
           'name' => ['required'],
           'date' => ['required'],
           'task_id' => ['required'],
           'hours' => ['required'],
           'minutes' => ['required'],
        ]);
        try{
            $project = Project::findorfail($request->project_id);
            $data=$request->all();
            $data['unit_amount']=$this->convertToFloat($request->hours,$request->minutes);
            $data['amount']=$data['unit_amount']*$project->cost_hours;
            $data['validate']=true;
            $data['old_unit_amount'] = 0;
            app(ProjectTaskController::class)->UpdateProgress($request,$request->task_id,$data);
            AccountAnalyticLine::create($data);
            return back(303);
        }catch(\Exception $e){
            return abort(500);
        }
    }

    public function destroy(Request $request,$timeId){
        $timesheet = AccountAnalyticLine::findorfail($timeId);
        $data['unit_amount']=0;
        $data['old_unit_amount'] = $timesheet->unit_amount;
        app(ProjectTaskController::class)->UpdateProgress($request,$timesheet->task_id,$data);
        $timesheet->delete();
        return back(303);
    }

    public function convertToFloat($hours,$minutes){
        $minutes = ($hours * 60) + $minutes;
        $float = $minutes / 60;
        return $float;
    }

    public function update(Request $request){
        $request->validateWithBag("Timesheet.{$request->id}",[
           'name' => ['required'],
           'date' => ['required'],
           'task_id' => ['required'],
           'hours' => ['required'],
           'minutes' => ['required'],
        ]);
        try{
            $timesheet = AccountAnalyticLine::findorfail($request->id);
            $project = Project::findorfail($timesheet->project_id);
            $data=$request->all();
            $data['unit_amount']=$this->convertToFloat($request->hours,$request->minutes);
            $data['amount']=$data['unit_amount']*$project->cost_hours;
            $data['validate']=true;
            $data['old_unit_amount'] = $timesheet->unit_amount;
            app(ProjectTaskController::class)->UpdateProgress($request,$timesheet->task_id,$data);
            $timesheet->update($data);
            return back(303);
        }catch(\Exception $e){
            return abort(500);
        }
    }
    public function getTimesheetAnalysis($ProjectId){
        $query = "to_char(date(date),'YYYY-MM') as Month, sum(unit_amount) as time";
        $result = AccountAnalyticLine::select(DB::raw($query))->where('project_id',$ProjectId)->groupBy(DB::raw("to_char(date(date),'YYYY-MM')"))->get();
        return $result;
    }

    public function getProjectCost($ProjectId){
        $query = "to_char(date(date),'YYYY-MM') as Month, sum(amount) as amount";
        $result = AccountAnalyticLine::select(DB::raw($query))->where('project_id',$ProjectId)->groupBy(DB::raw("to_char(date(date),'YYYY-MM')"))->get();
        return $result;
    }
 
    public function getParticipants($ProjectId){
        $query = "account_analytic_lines.user_id, sum(account_analytic_lines.unit_amount) as hours, sum(project_tasks.progress) as progress, count(project_tasks.progress) as count";
        $result = AccountAnalyticLine::select(DB::raw($query))->join('project_tasks','project_tasks.id','account_analytic_lines.task_id')->where('account_analytic_lines.project_id',$ProjectId)->groupBy('account_analytic_lines.user_id')->get();
        return $result;
    }

    public function getTimesheetTask($ProjectId){
        $query = "to_char(date(date),'YYYY-MM') as Month, sum(unit_amount) as time, task_id ";
        $result = AccountAnalyticLine::select(DB::raw($query))->where('project_id',$ProjectId)->groupBy(DB::raw("to_char(date(date),'YYYY-MM'),task_id"))->get();
        return $result;
    }

    public function computeTimesheetCost($ProjectId){
        $result = AccountAnalyticLine::where("project_id",$ProjectId)->sum('amount');
        return $result;
    }
}
