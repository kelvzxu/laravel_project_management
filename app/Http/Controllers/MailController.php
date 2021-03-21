<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InvitationMail;
use Mail;

class MailController extends Controller
{
     public function basic_email() {
      $data = array('name'=>"Prudence",'team'=>"Kelvinzxu team",'admin'=>"Kelvin Leonardi");
   
      Mail::send(['text'=>'Mail.testmail'], $data, function($message) {
         $message->to('ceokelvin12@gmail.com', 'prudence')->subject
            ('Laravel Basic Testing Mail');
         $message->from('no_reply@kltech-intl.technology','laravel Project Management');
      });
      echo "Basic Email Sent. Check your inbox.";
   }
   public function SendInvitationEmaill($request) {
        $data = new \stdClass();
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->admin = $request['admin'];
        $data->team = $request['team'];
        
        Mail::to($request['email'],$request['name'])->send(new InvitationMail($data));
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
