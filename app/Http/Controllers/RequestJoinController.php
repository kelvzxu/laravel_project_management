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

            $this->prepareRequestEmailData($request,$team);
        }
    }

    public function prepareRequestEmailData($request, $team){
        $data = [
            'admin' => $team->owner->name,
            'admin_mail' => $team->owner->email,
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
        try{
            $requestjoin = $this->getRequest($request, $teamId, $userId);
            $this->remove($request,$requestjoin);
            return redirect(config('fortify.home'));
        }catch(\Exception $e){
        }
    }

    public function show(Request $request, $teamId){
        $requestjoin = RequestJoin::where('team_id',$teamId)->get();
        return $requestjoin;
    }

    public function Approve(Request $request , $teamId, $userId){
        $requestjoin = $this->getRequest($request, $teamId, $userId);
        $response = $requestjoin->load('user','team');
        app(AddsTeamMembers::class)->join(
                $response->user,
                $response->team,
                $response->user->email ?: '',
                $response->role
            );
        $this->prepareApprovedEmailData($response);
        $this->remove($request,$requestjoin);

        return back(303);
    }

    public function prepareApprovedEmailData($request){
        $data = [
            'email' => $request->user->email,
            'name' => $request->user->name,
            'team' => $request->team->name,
        ];

        app(MailController::class)->SendApproveJoinEmail($data);
        
    }

    public function remove(Request $request , $requestjoin){
        $requestjoin->delete();
    }

    public function getRequest(Request $request , $teamId, $userId){
        $requestjoin = RequestJoin::where('user_id',$userId)->where('team_id',$teamId)->first();
        return $requestjoin;
    }
}
