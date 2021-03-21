<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestJoin;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\RedirectsActions;
use Laravel\Jetstream\Contracts\AddsTeamMembers;

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

            $this->prepareEmailData($request,$team);
        }
    }

    public function prepareEmailData($request, $team){
        $user = Jetstream::findUserByIdOrFail($team->user_id);
        $data = [
            'admin' => $user->name,
            'admin_mail' => $user->email,
            'email' => $request->user()->email,
            'name' => $request->user()->name,
            'team' => $team->name,
        ];
        app(MailController::class)->SendRequestJoinEmail($data);
        
    }

    public function validateUser(Request $request, $team){
        $count = RequestJoin::where('user_id',$request->user()->id)->where('team_id',$team->id)->count();
        return $count;
    }

    public function destroy(Request $request, $teamId, $userId)
    {
        $requestjoin = $this->getRequest($request, $teamId, $userId);
        $this->remove($request,$requestjoin);
        return redirect(config('fortify.home'));
    }

    public function show(Request $request, $teamId){
        $requestjoin = RequestJoin::where('team_id',$teamId)->get();
        return $requestjoin;
    }

    public function Approve(Request $request , $teamId, $userId){
        $requestjoin = $this->getRequest($request, $teamId, $userId);
        $response = $requestjoin->load('user','team');
        // dd($response->user->email);
        app(AddsTeamMembers::class)->join(
                $response->user,
                $response->team,
                $response->user->email ?: '',
                $response->role
            );
        $this->remove($request,$requestjoin);

        return back(303);
    }

    public function remove(Request $request , $requestjoin){
        $requestjoin->delete();
    }

    public function getRequest(Request $request , $teamId, $userId){
        $requestjoin = RequestJoin::where('user_id',$userId)->where('team_id',$teamId)->first();
        return $requestjoin;
    }
}
