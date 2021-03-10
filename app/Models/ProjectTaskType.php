<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Project;
use App\Models\ProjectTask;

class ProjectTaskType extends Model
{
    use HasFactory;

    protected $fillable = [
        'active','name','description','sequence','legend_blocked',
        'legend_done','legend_normal','mail_template_id','fold',
        'auto_validation_kanban_state','is_closed','create_uid','write_uid',
    ];

    public function tasks(){
        return $this->hasMany(ProjectTask::class,'stage_id','id');
    }

    
}
