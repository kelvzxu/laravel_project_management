<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ir_attachment;
use Illuminate\Support\Facades\Auth;

class IrAttachmentController extends Controller
{
    public function store($request){
        try{
            $data=$request;
            $data['create_uid'] = Auth::id();
            $data['write_uid'] = Auth::id();
            $attachment = ir_attachment::create($data);
            return $attachment;
        }catch(\Exception $e){
            echo"$e";
        }
    }
}
