<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\ir_attachment;
use Illuminate\Support\Facades\Auth;

class IrAttachmentController extends Controller
{
    public function store($request){
        try{
            $data=$request;
            $data['url']=$this->uploadfile($data['file']);
            $data['create_uid'] = Auth::id();
            $data['write_uid'] = Auth::id();
            $attachment = ir_attachment::create($data);
            return $attachment;
        }catch(\Exception $e){
            echo"$e";
        }
    } 

    public function uploadfile(UploadedFile $file)
    {
        $url=$file->storePublicly(
                    'profile-photos', ['disk' => $this->profilePhotoDisk()]
        );
        return $url;
    }

    protected function profilePhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
