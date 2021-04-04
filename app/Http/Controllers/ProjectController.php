<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\Auth\InheritTeamController;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\ProjectTask;
use DB;

class ProjectController extends Controller
{
    public function Store(Request $request){
        try{
            $data=$request->all();
            $data['access_token']=bin2hex(random_bytes(24));
            $data['date_start']=date("Y-m-d");
            $project=Project::create($data);
            $this->StoreProjectUsers($request,$project->id);
            return back(303);
        }catch(\Exception $e){
            echo"$e";
        }
    }

    public function StoreProjectUsers(Request $request,$projectId){
        try{
            $projectuser = ProjectUser::where('team_id',$request->team_id)
                                        ->where('user_id',$request->user_id)
                                        ->where('project_id',$projectId)->first();
            if (!$projectuser){
                $data=$request->all();
                $data['project_id']=$projectId;
                $project=ProjectUser::create($data);
            }
            return back(303);
        }catch(\Exception $e){
        }
    }

    public function show(Request $request,$projectId){
        $user = app(UsersController::class)->getUserbyID(Auth::id());
        $response = $this-> getProjectDetail($projectId);
        $team = app(InheritTeamController::class)->getTeam($response->team_id);
        return Jetstream::inertia()->render($request, 'Project/Show', [
            'users' => $user,
            'team' =>$team->load('owner', 'users'),
            'project' =>$response
        ]);
    }

    public function view(Request $request,$projectId){
        try{

            $user = app(UsersController::class)->getUserbyID(Auth::id());
            $response = $this-> getProjectDetail($projectId);
            $team = app(InheritTeamController::class)->getTeam($response->team_id);
            return Jetstream::inertia()->render($request, 'Project/View', [
                'users' => $user,
                'team' =>$team->load('owner', 'users'),
                'project' =>$response->load('participants','participants.user')
            ]);
        }catch(\Exception $e){
            return abort(404);
        }
    }

    public function getTeamProject($teamId){
        $response = Project::with('manager','user')->where('team_id','=',$teamId)->get();
        return $response;
    }

    public function getProjectDetail($token){
        $result = Project::with('task_type','task_type.tasks','task_type.tasks.tags','task_type.tasks.responsible','manager','team','task','participants','participants.user')->where('access_token','=',$token)->first();
        return $result;
    }

    public function update(Request $request){
        $project = Project::findOrFail($request->id);
        $project->update($request->all());
        return back(303);
    }

    public function archive(Request $request,$id){
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect(config('fortify.home'));
    }

    public function destroyParticipants(Request $request,$Id){
        $result = ProjectUser::findOrFail($Id);
        $result->delete();
        return back(303);
    }

    public function getParticipants($projectId){
        $result = ProjectUser::with('user','project')->addSelect(['task' => ProjectTask::select(DB::raw("COUNT(*)"))
            ->whereColumn('project_id', 'project_users.project_id')
            ->whereColumn('user_id','=','project_users.user_id')
            ->limit(1)])->where('project_id',$projectId)->get();
        $data = [];
        foreach ($result as $participant){
            $data[] = [
                'name' => $participant->user->name,
                'project'=> $participant->project->name,
                'task' => $participant->task,
            ];
        }
        return $data;
    }
}
