<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'access_token','email_cc','active','name','description',
        'priority','sequence','stage_id','kanban_state','date_end',
        'date_assign','date_last_stage_update','project_id',
        'planned_hours','user_id','team_id','color','displayed_image_id',
        'email_from','working_hours_open','working_hours_close',
        'working_days_open','working_days_close','remaining_hours',
        'effective_hours','total_hours_spent','progress','overtime',
        'subtask_effective_hours','create_uid','write_uid',
    ];
}