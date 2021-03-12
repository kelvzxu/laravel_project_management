<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
// Import Module dependency
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\Auth\InheritTeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RequestJoinController;

class PageController extends Controller
{
    public function Search(Request $request,$UserID)
    {
        $users = app(UsersController::class)->fetchUser($UserID);
        $teams = app(InheritTeamController::class)->fetchTeams($UserID);
        return Jetstream::inertia()->render($request, 'Search/Search', [
            'teams' => $teams,
            'users' => $users,
        ]); 
    }

    public function Dashboard(Request $request)
    {
        $user = app(UsersController::class)->getUserbyID(Auth::id());
        if ($user->current_team_id)
            $team = app(InheritTeamController::class)->getTeam($user->current_team_id);
        else
            $team = app(InheritTeamController::class)->getTeamByowner($user->id);
        $projects = app(ProjectController::class)->getTeamProject($team->id);
        return Jetstream::inertia()->render($request, 'Dashboard', [
            'users' => $user,
            'team' =>$team->load('owner', 'users'),
            'projects' =>$projects,
            'availableRoles' => array_values(Jetstream::$roles),
            'permissions' => [
                'canAddTeamMembers' => Gate::check('addTeamMember', $team),
                'canDeleteTeam' => Gate::check('delete', $team),
                'canRemoveTeamMembers' => Gate::check('removeTeamMember', $team),
                'canUpdateTeam' => Gate::check('update', $team),
            ],
        ]);
    }

    public function RequestJoin(Request $request, $teamId){
        $requestjoin = app(RequestJoinController::class)->show($request,$teamId);
        $user = app(UsersController::class)->getUserbyID(Auth::id());
        $team = app(InheritTeamController::class)->getTeam($user->current_team_id);
        return Jetstream::inertia()->render($request, 'Teams/RequestJoin', [
            'users' => $user,
            'team' =>$team->load('owner', 'users'),
            'requests' =>$requestjoin->load('user'),
            'availableRoles' => array_values(Jetstream::$roles),
            'permissions' => [
                'canAddTeamMembers' => Gate::check('addTeamMember', $team),
                'canDeleteTeam' => Gate::check('delete', $team),
                'canRemoveTeamMembers' => Gate::check('removeTeamMember', $team),
                'canUpdateTeam' => Gate::check('update', $team),
            ],
        ]);
    }
}
 