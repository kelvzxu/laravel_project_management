<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
// Dependencies Controllers
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\Auth\InheritTeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
// Dependencies Models
use App\Models\ProjectTag;
use App\Models\ProjectTask;

class ProjectTagController extends Controller
{
    public function getTagsProject(Request $request,$projectId){
        $result = ProjectTag::where('project_id',$projectId)->get();

        return $result;
    }
    public function show(Request $request,$token){
        $user = app(UsersController::class)->getUserbyID(Auth::id());
        $project = app(ProjectController::class)->getProjectDetail($token);
        $tags = $this->getTagsProject($request,$project->id);
        $team = app(InheritTeamController::class)->getTeam($project->team_id);

        return Jetstream::inertia()->render($request, 'Tags/Show', [
            'users' => $user,
            'project' =>$project,
            'tags' => $tags,
            'team' =>$team->load('owner', 'users'),
        ]);
    }

    public function store (Request $request){
        $request->validate([
           'name' => ['required'],
        ]);
        try{
            $data = $request->all();
            ProjectTag::create($data);
            return back(303);
        }catch(\Exception $e){
            return abort(500);
        }
    }

    public function update(Request $request){
         $request->validate([
           'name' => ['required'],
        ]);
        $data = $request->all();
        $tags = ProjectTag::findorFail($request->id);
        $tags->update($data);
        return back(303);
    }

    public function destroy(Request $request,$tagsId){
        $this->removeRelationTask($request,$tagsId);
        $data = $request->all();
        $tags = ProjectTag::findorFail($tagsId);
        $tags->delete();
        return back(303);
    }

    public function removeRelationTask(Request $request,$tagsId){
        $tasks = ProjectTask::where('tag_id',$tagsId)->get();
        foreach($tasks as $e => $data){
            $data->update([
                'tag_id'=>null,
            ]);
        }
    }
}
