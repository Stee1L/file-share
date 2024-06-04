<?php

namespace App\Src\Services;

use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use App\Src\Error\CustomError;
use App\Src\Request\FolderRequest;
use App\Src\Response\FolderResource;
use Illuminate\Support\Facades\Storage;

class FolderService
{
    public static function createFolder(FolderRequest $request, User $user): FolderResource
    {
        $newFolder = Folder::create([
            'name'=>$request->get('name'),
            'user_id'=>$user->id,
            'is_root'=>false,
            'folder_id'=>!is_null($request->get('parent_id')) ? $request->get('parent_id') : $user->folders->where('is_root', true)->first()->id,
        ]);

        return FolderResource::make($newFolder);
    }

    public static function delete(Folder $folder): int {
        if ($folder->is_root) {
            throw new CustomError(message: "Данную папку нельзя удалить");
        }
        $fileDelete = 0;
        $folder->childrens->each(function (Folder $folder) use(&$fileDelete) {
            $folder->files->each(function (File $file) use(&$fileDelete) {
                Storage::disk('public')->delete($file->path);
                $file->delete();
                $fileDelete+=1;
            });
            $folder->delete();
        });

        $folder->files->each(function (File $file) use(&$fileDelete) {
            Storage::disk('public')->delete($file->path);
            $file->delete();
            $fileDelete+=1;
        });

        $folder->delete();

        return $fileDelete;
    }
}
