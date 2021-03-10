<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTaskTypeRel extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_task_type_id',
        'project_id',
    ];
}
