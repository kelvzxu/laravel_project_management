<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Laravel\Jetstream\Actions\ValidateTeamDeletion;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Contracts\DeletesTeams;
use Laravel\Jetstream\Contracts\UpdatesTeamNames;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\RedirectsActions;
use Laravel\Jetstream\Http\Controllers\Inertia\TeamController;

class InheritTeamController extends TeamController
{
    public function getMyTeams (Request $request, $userId){
        $teams = Jetstream::newTeamModel()->where('user_id','=',$userId)->get();

        // dd($teams);
        return Jetstream::inertia()->render($request, 'Teams/MyTeam', [
            'team' => $teams->load('owner', 'users'),
        ]);
    }
}
