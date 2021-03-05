<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'access_token','name','description','active','sequence','user_id',
        'team_id','label_tasks','date_start','date_end','allow_subtasks',
        'allow_recurring_tasks','rating_active' ,'rating_status','rating_status_period',
        'allow_timesheets','allow_timesheet_timer','create_uid','write_uid'

    ];

    public function Manager(){
        return $this->hasOne(User::class,'id','user_id');
    }

}
