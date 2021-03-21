<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Mail template
use App\Mail\InvitationMail;
use App\Mail\RequestJoinMail;
use App\Mail\ApproveJoinMail;
use Mail;

class MailController extends Controller
{
   public function SendInvitationEmail($request) {
        $data = new \stdClass();
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->admin = $request['admin'];
        $data->team = $request['team'];
        
        Mail::to($request['email'],$request['name'])->send(new InvitationMail($data));
   }

    public function  SendRequestJoinEmail($request) {
        $data = new \stdClass();
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->admin = $request['admin'];
        $data->team = $request['team'];
        
        Mail::to($request['admin_mail'],$request['admin'])->send(new RequestJoinMail($data));
   }
  
    public function  SendApproveJoinEmail($request) {
        $data = new \stdClass();
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->team = $request['team'];
        
        Mail::to($request['email'],$request['name'])->send(new ApproveJoinMail($data));
   }

}
