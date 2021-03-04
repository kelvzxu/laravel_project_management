<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\Auth\InheritTeamController;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;

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
        $team = app(InheritTeamController::class)->getTeam($user->current_team_id);
        return Jetstream::inertia()->render($request, 'Dashboard', [
            'users' => $user,
            'team' =>$team->load('owner', 'users'),
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
 