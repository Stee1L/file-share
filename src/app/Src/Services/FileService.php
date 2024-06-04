<?php

namespace App\Src\Services;

use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use App\Src\Request\CreateFileRequest;
use App\Src\Request\FileRequest;
use App\Src\Request\UpdateFileRequest;
use App\Src\Response\FileDeleteResource;
use App\Src\Response\FileResource;
use App\Src\Response\MovedFileResponse;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class FileService
{
    public static function upload(File $file, FileRequest $request): FileResource
    {
        $originalExt = $request->file->getClientOriginalExtension();
        $newName = Uuid::uuid4()->toString() . '.' . $originalExt;
        $file->update([
            'path' => $request->file->storeAs('files', $newName, 'public'),
            'original_name' => $request->file->getClientOriginalName(),
        ]);

        return new FileResource($file);
    }

    public static function createFile(CreateFileRequest $request, User $currentUser)
    {
        $file = File::create([
            'path' => '',
            'original_name' => '',
            'user_id' => $currentUser->id,
            'folder_id' => is_null($request->parent) ? $currentUser->folders->where('is_root', true)
                ->first()->id : $request->parent
        ]);
        return [
            'file_id' => $file->id
        ];
    }


    public static function getFiles(File $file, User $currentUser): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return FileResource::collection($currentUser->files);
    }

    public static function download(File $file, User $currentUser): FileResource
    {
        return new FileResource($file);
    }

    public static function delete(File $file): FileDeleteResource
    {
        $messages = [
            "Следующий уровень: Удаление файла '{$file->original_name}' успешно завершено!",
            "Файл '{$file->original_name}' удален! Кажется, вы освободили место для новых приключений!",
            "Конец файла '{$file->original_name}'! Следующий!",
            "Удалено: '{$file->original_name}'. Миссия выполнена!",
            "Файл '{$file->original_name}' исчез! Но не беспокойтесь, ваше приключение продолжается!"
        ];

        $randomMessage = $messages[array_rand($messages)];
        $filePath = $file->path;
        $file->delete();

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        return new FileDeleteResource($randomMessage);
    }

    public static function rename(UpdateFileRequest $request, File $file): FileResource
    {
        $file->update([
            'original_name' => $request->name
        ]);
        return new FileResource($file);
    }

    public static function move(File $file, Folder $folder): MovedFileResponse
    {
        $file->update([
            'folder_id' => $folder->id
        ]);
        $file->refresh();

        return new MovedFileResponse($file);
    }
}
