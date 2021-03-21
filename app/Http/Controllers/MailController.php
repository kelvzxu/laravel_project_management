<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Mail template
use App\Mail\InvitationMail;
use App\Mail\RequestJoinMail;
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
        
        Mail::to($request['admin_mail'],$request['name'])->send(new RequestJoinMail($data));
   }
  
   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('ceokelvin12@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('no_reply@kltech-intl.technology','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}
