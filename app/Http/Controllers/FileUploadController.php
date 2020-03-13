<?php

namespace App\Http\Controllers;

use App\File;
use App\Image;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    use UploadFile;

    protected $imagesAcceptedTypes = ['jpeg', 'jpg', 'png'];

    public function fileStore(Request $request)
    {
        return $this->upload($request['file']);
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        $fileType =  $request->get('type');
        // first check for type
        if (in_array($fileType, $this->imagesAcceptedTypes)){ // if file is image delete from DB if exist
            Image::where('path', $filename)->delete();
        }
        return $filename;
    }

    public function getFiles($id, $type) // get data for dropzone init function
    {
        $images = Image::where('imageable_id', $id)->where('imageable_type', 'App\\'.$type)->get()->toArray();
        $result = [];

        foreach ($images as $image){
            $size = Storage::size($image['path']);
            $type = pathinfo(Storage::url($image['path']), PATHINFO_EXTENSION);
            array_push($result, ['name' => $image['path'], 'size' => $size, 'type' => $type]);
        }

        return response()->json($result);
    }

}
