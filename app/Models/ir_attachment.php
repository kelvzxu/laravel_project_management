<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ir_attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','res_model','res_field','res_id','type','size','url','create_uid','write_uid',
    ];
}
