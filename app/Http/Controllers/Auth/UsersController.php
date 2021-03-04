<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use App\Models\UserFriend;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

class UsersController extends UserProfileController
{
    public function fetchUser($UserID)
    {
        $response = user::with('followers','following')->addSelect(['state' => UserFriend::select('state')
            ->whereColumn('friend_id', 'users.id')
            ->where('user_id','=',$UserID)
            ->limit(1)
        ])->where('id','!=',$UserID)->get();

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

    public function getUser($user)
    {
        $user = $this->findUser($user);
        $response = user::with('followers.userfollowers','following.userfollowing')->where('email','=',$user->email)->first();

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

    public function findUser($mail){
        $user = user::where('email',$mail)->first();
        return $user;
    }

    public function getUserbyID($params){
        $user = user::findOrFail($params);
        return $user;
    }
}
