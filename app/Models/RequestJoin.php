<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class RequestJoin extends Model
{
    /**
     * The table associated with the pivot model.
     *
     * @var string
     */
    protected $table = 'team_user_requests';
    protected $fillable = [
        'team_id','user_id','role',
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
