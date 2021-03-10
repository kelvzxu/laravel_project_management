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
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\RedirectsActions;
use Laravel\Jetstream\Http\Controllers\Inertia\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IrAttachmentController;
use App\Http\Controllers\Auth\UsersController;
use App\Models\Team;
use App\Models\Membership;

class InheritTeamController extends TeamController
{
    public function show(Request $request, $teamId)
    {
        $team = Jetstream::newTeamModel()->findOrFail($teamId);
        $projects = app(ProjectController::class)->getTeamProject($team->id);

        return Jetstream::inertia()->render($request, 'Teams/Show', [
            'team' => $team->load('owner', 'users','banner'), 
            'projects'=> $projects,
            'availableRoles' => array_values(Jetstream::$roles),
            'availablePermissions' => Jetstream::$permissions,
            'defaultPermissions' => Jetstream::$defaultPermissions,
            'permissions' => [
                'canAddTeamMembers' => Gate::check('addTeamMember', $team),
                'canDeleteTeam' => Gate::check('delete', $team),
                'canRemoveTeamMembers' => Gate::check('removeTeamMember', $team),
                'canUpdateTeam' => Gate::check('update', $team),
            ],
        ]);
    }
    public function getMyTeams (Request $request){
        $teams = Jetstream::hasTeamFeatures() ? $request->user()->allTeams() : null;
        return Jetstream::inertia()->render($request, 'Teams/MyTeam', [
            'teams' => $teams->load('owner', 'users'),
        ]);
    }

    public function getTeams (Request $request, $userId){
        $users = app(UsersController::class)->findUser($userId);
        $user = app(UsersController::class)->getUser($userId);
        $teams = Jetstream::hasTeamFeatures() ? $users->allTeams() : null;
        return Jetstream::inertia()->render($request, 'Public/Team', [
            'teams' => $teams->load('owner', 'users'),
            'users' => $user,
        ]);
    }

    public function fetchTeams($UserID)
    {
        $response = team::addSelect(['join' => Membership::select('role')->whereColumn('team_id', 'teams.id')
                        ->where('user_id','=',$UserID)
                        ->limit(1)
                    ])->where('user_id','!=',$UserID)->get();
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

    public function Join(Request $request, $teamId)
    {
        $team = Jetstream::newTeamModel()->findOrFail($teamId);

        app(AddsTeamMembers::class)->join(
            $request->user(),
            $team,
            $request->email ?: '',
            $request->role
        );

        return back(303);
    }

    public function getTeam($teamId)
    {
        $team = Jetstream::newTeamModel()->findOrFail($teamId);
        return $team;
    }

    public function getTeamByowner($userId)
    {
        $team = Jetstream::newTeamModel()->where('user_id','=',$userId)->first();
        $team = $this->getTeam($team->id);
        return $team;
    }

    public function store(Request $request)
    {
        $creator = app(CreatesTeams::class);
        $team = $creator->create($request->user(), $request->all());
        if ($request->attachment){
            $params = $request->attachment;
            $params['res_id']= $team->id;
            $attachment = app(IrAttachmentController::class)->store($params);
            $data = $request->all();
            if ($attachment->id){
                $data['banner_image_id'] = $attachment->id;
            }
            $data = $team->update($data);
        }
        return $this->redirectPath($creator);
    }
}
