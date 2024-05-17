<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Src\Request\FileRequest;
use App\Src\Response\FileResource;
use App\Src\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadFile(FileRequest $request): FileResource
    {
        return FileService::upload($request, auth()->user());
    }

    public function getFiles()
    {
        return FileResource::collection(auth()->user()->files);
    }

    public function deleteFile(File $file)
    {
        $this->authorize('delete', $file);
        return FileService::delete($file);
    }


    public function downloadFile(Request $request, File $file)
    {
        $this->authorize('view', $file);
        return FileService::download($file, auth()->user());
    }
}
