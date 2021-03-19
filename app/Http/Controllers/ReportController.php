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
// use DateTime;

class ReportController extends Controller
{
    public function OverviewReport(Request $request,$token)
    {
        $project = app(ProjectController::class)->getProjectDetail($token);
        $team = app(InheritTeamController::class)->getTeam($project->team_id);
        

        return Jetstream::inertia()->render($request, 'Report/Overview', [
            'project' =>$project,
            'team' =>$team->load('owner', 'users'),
        ]);
    }
    public function TaskAnalysisReport(Request $request,$token)
    {
        $project = app(ProjectController::class)->getProjectDetail($token);
        $team = app(InheritTeamController::class)->getTeam($project->team_id);
        
        $responsible = app(ProjectController::class)->getParticipants($project->id);

        return Jetstream::inertia()->render($request, 'Report/TaskAnalysis', [
            'project' =>$project,
            'team' =>$team->load('owner', 'users'),
            'task_analysis' => $responsible
        ]);
    }
    public function TimesheetPlanningAnalysisReport(Request $request,$token)
    {
        $project = app(ProjectController::class)->getProjectDetail($token);
        $team = app(InheritTeamController::class)->getTeam($project->team_id);
        
        $planned_hours = app(ProjectTaskController::class)->getPlannedAnalysis($project->id);
        $timesheet = app(AccountAnalyticLineController::class)->getTimesheetAnalysis($project->id);
        $analysis = $this->prepareTimesheetPlanningAnalysis($planned_hours,$timesheet);

        return Jetstream::inertia()->render($request, 'Report/TimesheetPlanning', [
            'project' =>$project,
            'team' =>$team->load('owner', 'users'),
            'analysis' => $analysis,
        ]);
    }

    public function prepareTimesheetPlanningAnalysis($planned_hours,$timesheets){
        $data = [];
        for ($i = 0; $i <= 12; $i++) {
            $month = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
            $timesheet = $timesheets->firstWhere('month', $month);
            $planned = $planned_hours->firstWhere('month', $month);
            $month=date("F",strtotime($month));
            $data[] = [
                'month' =>$month,
                'timesheet' => $timesheet ? $timesheet->time:0,
                'planned' => $planned ? $planned->time:0,
            ];
            $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
        }        
        return $data;
    }
}
