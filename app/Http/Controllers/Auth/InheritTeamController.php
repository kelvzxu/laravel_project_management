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
            'teams' => $teams->load('owner', 'users'),
        ]);
    }
    public function fetchTeams(Request $request)
    {
        $response = Jetstream::newTeamModel()->get();
        if ($response) {
            return response()->json([
                'status' => 'success',
                'result' => $response
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'result' => []
        ]);
    }
}
