<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\MailController;
use Laravel\Jetstream\Actions\RemoveTeamMember;
use Laravel\Jetstream\Actions\UpdateTeamMemberRole;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Laravel\Jetstream\Http\Controllers\Inertia\TeamMemberController;
use Laravel\Jetstream\Jetstream;

class InheritTeamMemberController extends TeamMemberController
{
    /**
     * Add a new team member to a team.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $teamId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $teamId)
    {
        $team = Jetstream::newTeamModel()->findOrFail($teamId);

        app(AddsTeamMembers::class)->add(
            $request->user(),
            $team,
            $request->email ?: '',
            $request->role
        );
        $this->prepareEmailData($request,$team);
        return back(303);
    }
    
    public function prepareEmailData($request, $team){
        $user = Jetstream::findUserByEmailOrFail($request->email);
        $data = [
            'admin' => $request->user()->name,
            'email' => $request->email,
            'name' => $user->name,
            'team' => $team->name,
        ];
        app(MailController::class)->SendInvitationEmail($data);
        
    }

    /**
     * Update the given team member's role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $teamId
     * @param  int  $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $teamId, $userId)
    {
        app(UpdateTeamMemberRole::class)->update(
            $request->user(),
            Jetstream::newTeamModel()->findOrFail($teamId),
            $userId,
            $request->role
        );

        return back(303);
    }

    /**
     * Remove the given user from the given team.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $teamId
     * @param  int  $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $teamId, $userId)
    {
        $team = Jetstream::newTeamModel()->findOrFail($teamId);

        app(RemoveTeamMember::class)->remove(
            $request->user(),
            $team,
            $user = Jetstream::findUserByIdOrFail($userId)
        );

        if ($request->user()->id === $user->id) {
            return redirect(config('fortify.home'));
        }

        return back(303);
    }
}
