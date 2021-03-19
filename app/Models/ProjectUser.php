<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// dependencies Models
use App\Models\Team;
use App\Models\user;
use App\Models\Project;

class ProjectUser extends Model
{
    use HasFactory;

    protected $fillable = ['project_id','user_id','team_id'];

    public function project(){
        return $this->hasOne(Project::class,'id','project_id');
    }

    public function team(){
        return $this->hasOne(Team::class,'id','team_id');
    }

    public function user(){
        return $this->hasOne(user::class,'id','user_id');
    }

}
