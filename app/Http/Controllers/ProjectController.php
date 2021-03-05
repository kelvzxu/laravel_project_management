<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function Store(Request $request){
        try{
            $data=$request->all();
            Project::create($data);
            return back(303);
        }catch(\Exception $e){
            echo"$e";
        }
    }

    public function getTeamProject($teamId){
        $response = Project::with('manager')->where('team_id','=',$teamId)->get();
        return $response;
    }
}
