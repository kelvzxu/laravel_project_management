<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

class SessionsController extends UserProfileController
{
    /**
     * Show the general profile settings screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function session(Request $request)
    {
    //     $x = date("Y-m-d H:i:s", 1610041926);
    // echo $x;

        
        return Jetstream::inertia()->render($request, 'Profile/Session', [
            'sessions' => $this->sessions($request)->all(),
        ]);
    }

    
}
