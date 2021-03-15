<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'project_id',
        'create_uid',
        'write_uid',
    ];
}
