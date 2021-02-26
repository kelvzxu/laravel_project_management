<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\Auth\InheritTeamController;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;

class SearchController extends Controller
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
}
