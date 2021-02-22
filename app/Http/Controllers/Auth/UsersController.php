<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

class UsersController extends UserProfileController
{
    public function fetchUser($UserID)
    {
        $response = user::where('id','!=',$UserID)->get();
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
