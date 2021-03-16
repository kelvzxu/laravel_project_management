<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountAnalyticLine;
use App\Http\Controllers\ProjectTaskController;

class AccountAnalyticLineController extends Controller
{
    public function fetchAnalyticLine (Request $request,$ProjectId){
       $result = AccountAnalyticLine::where("project_id",$ProjectId)->orderByDESC('updated_at')->get();
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
            $data=$request->all();
            $data['unit_amount']=$this->convertToFloat($request->hours,$request->minutes);
            $data['amount']=$data['unit_amount'];
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
            $data=$request->all();
            $data['unit_amount']=$this->convertToFloat($request->hours,$request->minutes);
            $data['amount']=$data['unit_amount'];
            $data['validate']=true;
            $data['old_unit_amount'] = $timesheet->unit_amount;
            app(ProjectTaskController::class)->UpdateProgress($request,$timesheet->task_id,$data);
            $timesheet->update($data);
            return back(303);
        }catch(\Exception $e){
            return abort(500);
        }
    }
}
