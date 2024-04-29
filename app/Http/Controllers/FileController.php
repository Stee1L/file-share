<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileResource;
use App\Models\File;
use http\Env\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class FileController extends Controller
{
    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $originalExt = $file->extension();
        $newName = \Faker\Provider\Uuid::uuid().'.'.$originalExt;
        File::create([
            'path'=>$file->storeAs('files', $newName, 'public'),
            'original_name'=>$file->getClientOriginalName(),
            'user_id'=>auth()->user()->id
        ]);
        //$request->file('file')->storeAs('files', $request->file('file')->getClientOriginalName(), 'public');
        return response()->json([
            'message'=>'File upload'
        ]);
    }

    public function getFiles()
    {
        return FileResource::collection(auth()->user()->files);
    }

    public function downloadFile(Request $request, File $file)
    {
        $this->authorize('view', $file);
        return response()->json([
            'url'=> Storage::disk('public')->url($file->path)
        ]);
    }
}
