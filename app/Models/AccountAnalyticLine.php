<?php

namespace App\Models;

// Base Dependencies
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Dependencies Models
use App\Models\user;
use App\Models\Team;
use App\Models\ProjectTask;
use App\Models\Project;

class AccountAnalyticLine extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'date',
        'amount',
        'unit_amount',
        'user_id',
        'team_id',
        'task_id',
        'project_id',
        'validate',
        'create_uid',
        'write_uid',
    ];

    public function team(){
        return $this->hasOne(Team::class,'id','team_id');
    }

    public function responsible(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function task(){
        return $this->hasOne(ProjectTask::class,'id','task_id');
    }

    public function project(){
        return $this->hasOne(Project::class,'id','team_id');
    }

}
