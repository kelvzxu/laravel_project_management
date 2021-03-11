<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestJoin;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\RedirectsActions;

class RequestJoinController extends Controller
{
    public function request(Request $request, $team){
        $validation = $this->validateUser($request, $team);
        if ($validation == 0){
            RequestJoin::create([
                'team_id'=> $team->id,
                'user_id'=> $request->user()->id,
                'role'=>$request->role,
            ]);
        }
    }

    public function validateUser(Request $request, $team){
        $count = RequestJoin::where('user_id',$request->user()->id)->where('team_id',$team->id)->count();
        return $count;
    }

    public function destroy(Request $request, $teamId, $userId)
    {
        $requestjoin = RequestJoin::where('user_id',$userId)->where('team_id',$teamId)->first();
        $requestjoin->delete();
        return redirect(config('fortify.home'));
    }

    public function show(Request $request, $teamId){
        $requestjoin = RequestJoin::where('team_id',$teamId)->get();
        return $requestjoin;
    }
}
