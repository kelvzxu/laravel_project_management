<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

class UserFriend extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','friend_id'
    ];

    public function userfollowers()
    {
        return $this->hasOne(User::class,'id','user_id')->addSelect(['state' => UserFriend::select('state')
            ->whereColumn('friend_id', 'users.id')
            ->where('user_id','=',5)
            ->limit(1)
        ]);
    }
    public function userfollowing()
    {
        return $this->hasOne(User::class,'id','friend_id')->addSelect(['state' => UserFriend::select('state')
            ->whereColumn('friend_id', 'users.id')
            ->where('user_id','=',5)
            ->limit(1)
        ]);
    }
}
