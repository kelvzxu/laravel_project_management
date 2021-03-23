<?php

namespace App\Models;

// Base Dependencies
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
// Dependencies Models
use App\Models\user;
use App\Models\Team;
use App\Models\ProjectTaskType;
use App\Models\ProjectTask;
use App\Models\ProjectTag;
use App\Models\ProjectUser;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'access_token','name','description','active','sequence','user_id','cost_hours',
        'team_id','label_tasks','date_start','date_end','allow_subtasks','customer',
        'allow_recurring_tasks','rating_active' ,'rating_status','rating_status_period',
        'allow_timesheets','allow_timesheet_timer','create_uid','write_uid'

    ];

    public function Manager(){
        return $this->hasOne(User::class,'id','user_id');
    }
    
    public function task_type(){
        return $this->belongsToMany(ProjectTaskType::class,'project_task_type_rels','project_id','project_task_type_id')->orderBy('sequence');
    }

    public function team(){
        return $this->hasOne(Team::class,'id','team_id');
    }

    public function tags() {
        return $this->hasMany(ProjectTag::class);
    }

    public function task() {
        return $this->hasMany(ProjectTask::class);
    }

    public function participants() {
        return $this->hasMany(ProjectUser::class);
    }

    public function user() {
        return $this->hasone(ProjectUser::class)->where('user_id',Auth::id());
    }
}
