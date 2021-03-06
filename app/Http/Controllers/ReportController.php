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
        $hours = app(ProjectTaskController::class)->getHoursRecorded($project->id);
        $participants = app(AccountAnalyticLineController::class)->getParticipants($project->id);
        $timesheetCost = app(AccountAnalyticLineController::class)->computeTimesheetCost($project->id);
        $progressdetails = $this->prepareTimesheetPlanning($project);
        for ($i = 0; $i <= 3; $i++) {
            $month = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
            $months[] = $month=date("F",strtotime($month));
        }
        return Jetstream::inertia()->render($request, 'Report/Overview', [
            'project' =>$project, 
            'team' =>$team->load('owner', 'users'),
            'hours' => $hours,
            'participants'=>$participants->load('responsible'),
            'timesheetCost' => $timesheetCost,
            'analysis'=>$progressdetails,
            'months' => $months
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
        $analysis = $this->prepareTimesheetPlanningAnalysis($planned_hours,$timesheet,$project);

        return Jetstream::inertia()->render($request, 'Report/TimesheetPlanning', [
            'project' =>$project,
            'team' =>$team->load('owner', 'users'),
            'analysis' => $analysis,
        ]);
    }

    public function ProjectCostReport(Request $request,$token)
    {
        $project = app(ProjectController::class)->getProjectDetail($token);
        $team = app(InheritTeamController::class)->getTeam($project->team_id);
        
        $projectcost = app(AccountAnalyticLineController::class)->getProjectCost($project->id);
        $cost = $this->prepareProjectCost($projectcost,$project);
        return Jetstream::inertia()->render($request, 'Report/CostAnalysis', [
            'project' =>$project,
            'team' =>$team->load('owner', 'users'),
            'costs' => $cost,
        ]);
    }

    public function prepareTimesheetPlanningAnalysis($planned_hours,$timesheets,$project){
        $data = [];
        $date_start = $project->date_start;
        $year_month = date("Y-m",strtotime(date($date_start)));
        $new_date_start = "$year_month-01";
        for ($i = 0; $i <= 12; $i++) {
            $month = date("Y-m", strtotime( date($new_date_start)." +$i months"));
            $timesheet = $timesheets->firstWhere('month', $month);
            $planned = $planned_hours->firstWhere('month', $month);
            $year=date("Y",strtotime($month));
            $month=date("F",strtotime($month));
            $data[] = [
                'month' =>"$month $year",
                'timesheet' => $timesheet ? $timesheet->time:0,
                'planned' => $planned ? $planned->time:0,
            ];
        }        
        return $data;
    }

    public function prepareProjectCost($costs,$project){
        $data = [];
        $date_start = $project->date_start;
        $year_month = date("Y-m",strtotime(date($date_start)));
        $new_date_start = "$year_month-01";
        for ($i = 0; $i <= 12; $i++) {
            $month = date("Y-m", strtotime( date( $new_date_start )." +$i months"));
            $cost = $costs->firstWhere('month', $month);
            $year=date("Y",strtotime($month));
            $month=date("F",strtotime($month));
            $data[] = [
                'month' =>"$month $year" ,
                'cost' => $cost ? $cost->amount:0,
            ];
        }        
        return $data;
    }

    public function prepareTimesheetPlanning($project){
        $tasks = app(ProjectTaskController::class)->getTasks($project->id);
        $timesheets = app(AccountAnalyticLineController::class)->getTimesheetTask($project->id);
        foreach ($tasks as $task){
            $progress = [];
            $time_id ="";
            for ($i = 0; $i <= 3; $i++) {
                $month = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));

                $timesheet = $timesheets->Where('month', $month)->where('task_id',$task->id)->first();
                $month=date("F",strtotime($month));
                $time_id = $timesheet ? $timesheet->task_id:0;
                $progress[] = [
                    'month' =>$month,
                    'time' => $timesheet ? $timesheet->time:0,
                ];
            }
            $task->detail = $progress;
            
        }
        return $tasks;
    }
}
