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

class ReportController extends Controller
{
    public function TaskAnalysisReport(Request $request,$token)
    {
        $project = app(ProjectController::class)->getProjectDetail($token);
        $team = app(InheritTeamController::class)->getTeam($project->team_id);
        
        $responsible = app(ProjectController::class)->getParticipants($project->id);
        // $sales = sales_order::select(DB::raw('date(created_at) as date,sum(grand_total) as total'))
        // ->where('created_at', 'LIKE', '%' . $filter . '%')
        // ->groupBy(DB::raw('date(created_at)'))->get();
        // echo $responsible;
        // return Jetstream::inertia()->render($request, 'Report/TaskAnalysis', [
        //     'project' =>$project,
        //     'team' =>$team->load('owner', 'users'),
        // ]);
    }
}
