<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountAnalyticLine;

class AccountAnalyticLineController extends Controller
{
    public function fetchAnalyticLine (Request $request){
       $result = AccountAnalyticLine::get();
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
            AccountAnalyticLine::create($data);
            return back(303);
        }catch(\Exception $e){
            return abort(500);
        }
    }

    public function destroy(Request $request,$timeId){
        $timesheet = AccountAnalyticLine::findorfail($timeId);
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
            $data=$request->all();
            $data['unit_amount']=$this->convertToFloat($request->hours,$request->minutes);
            $data['amount']=$data['unit_amount'];
            $data['validate']=true;
            $timesheet = AccountAnalyticLine::findorfail($request->id);
            $timesheet->update($data);
            return back(303);
        }catch(\Exception $e){
            return abort(500);
        }
    }
}
