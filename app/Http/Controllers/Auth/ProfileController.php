<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

class ProfileController extends UserProfileController
{
    /**
     * Show the general profile settings screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function session(Request $request)
    {
        return Jetstream::inertia()->render($request, 'Profile/Session', [
            'sessions' => $this->sessions($request)->all(),
        ]);
    }

    public function updatePassword(Request $request)
    {
        return Jetstream::inertia()->render($request, 'Profile/Security');
    }

    public function preference(Request $request)
    {
        return Jetstream::inertia()->render($request, 'Profile/Preference');
    }

    public function sessions(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::table(config('session.table', 'sessions'))
                    ->where('user_id', $request->user()->getAuthIdentifier())
                    ->orderBy('last_activity', 'desc')
                    ->get()
        )->map(function ($session) use ($request) {
            $agent = $this->createAgent($session);
            $payload = unserialize(base64_decode($session->payload));
            return (object) [
                'agent' => [
                    'is_desktop' => $agent->isDesktop(),
                    'platform' => $agent->platform(),
                    'browser' => $agent->browser(),
                ],
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === $request->session()->getId(),
                'payload'=> $payload,
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    public function PublicProfile(Request $request, $user){
        $data = app(UsersController::class)->getUser($user);
        echo $data;
        // return Jetstream::inertia()->render($request, 'Search/Search', [
        //     'users' => $users,
        // ]);
    }
}
