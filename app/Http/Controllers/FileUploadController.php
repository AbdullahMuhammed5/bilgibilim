<?php

namespace App\Http\Controllers;

use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    use UploadFile;

    public function fileStore(Request $request)
    {
        return $this->upload($request['file']??$request->file('upload'));
    }

    public function ckEditorUpload(Request $request)
    {
        $fileName = $this->upload($request->file('upload'));
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = env('APP_URL').Storage::url($fileName);
        $msg = 'Image successfully uploaded';
        $render = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
        @header('Content-type: text/html; charset=utf-8');
        echo $render;
    }

}
