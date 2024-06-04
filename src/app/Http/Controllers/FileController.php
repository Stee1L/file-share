<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use App\Src\Error\CustomError;
use App\Src\Request\CreateFileRequest;
use App\Src\Request\FileRequest;
use App\Src\Request\MoveFileRequest;
use App\Src\Request\UpdateFileRequest;
use App\Src\Response\FileResource;
use App\Src\Response\MovedFileResponse;
use App\Src\Services\FileService;
use App\Src\Response\DownloadFile;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadFile(File $file, FileRequest $request): FileResource
    {
        $this->authorize('view', $file);
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

    public function update(UpdateFileRequest $request, File $file): FileResource
    {
        $this->authorize('update', $file);
        return FileService::rename($request, $file);
    }

    public function move(File $file,MoveFileRequest $request): MovedFileResponse {
        $folder = Folder::find($request->new_folder_id);
        $this->authorize('view', $file);
        if ($folder->user->id !== auth()->user()->id) {
            throw new CustomError(message: "Вы не можете сюда загрузить");
        }

        return FileService::move($file, $folder);
    }
}
