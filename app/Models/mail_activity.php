<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Dependencies Models
use App\Models\user;
use App\Models\Project;

class mail_activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'access_token',
        'activity_type',
        'due_date',
        'user_id',
        'project_id',
        'note',
        'state',
        'create_uid',
        'write_uid',
    ];

    public function responsible(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function project(){
        return $this->hasOne(Project::class,'id','project_id');
    }
}
