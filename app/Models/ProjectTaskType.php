<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Project;
use App\Models\ProjectTask;

class ProjectTaskType extends Model
{
    use HasFactory;

    public function tasks(){
        return $this->hasMany(ProjectTask::class,'stage_id','id');
    }

    
}
