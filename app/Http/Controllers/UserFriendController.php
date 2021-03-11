<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFriend;

class UserFriendController extends Controller
{
    public function FollowUser(Request $request)
    {
        try{
            $data=$request->all();
            UserFriend::create($data);
            return back(303);
        }catch(\Exception $e){
            return abort(404);
        }
    }
    public function UnfollowUser(Request $request)
    {
        try{
            $friend_list= UserFriend::where('user_id',$request->user_id)->where('friend_id',$request->friend_id)->first();
            $friend_list->delete();
            return back(303);
        }catch(\Exception $e){
            return abort(404);
        }
    }
}
