<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Src\Request\CreateFileRequest;
use App\Src\Request\FileRequest;
use App\Src\Response\FileResource;
use App\Src\Services\FileService;
use App\Src\Response\DownloadFile;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadFile(FileRequest $request, File $file): FileResource
    {
        return FileService::upload($file, $request);
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

    public function createFile(CreateFileRequest $request)
    {
        return FileService::createFile($request, auth()->user());
    }

    public function downloadFile(File $file)
    {
        $this->authorize('view', $file);
        return DownloadFile::make($file);
    }
}
