<?php

namespace App\Src\Services;

use App\Models\File;
use App\Models\User;
use App\Src\Request\FileRequest;
use App\Src\Response\FileDeleteResource;
use App\Src\Response\FileResource;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class FileService
{
    public static function upload(FileRequest $request, User $currentUser): FileResource {
        $originalExt = $request->file->getClientOriginalExtension();
        $newName = Uuid::uuid4()->toString() . '.' . $originalExt;
        $file = File::create([
            'path'=> $request->file->storeAs('files', $newName, 'public'),
            'original_name' => $request->file->getClientOriginalName(),
            'user_id'=>$currentUser->id
        ]);

        return new FileResource($file);
    }


    public static function getFiles(File $file, User $currentUser): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return FileResource::collection($currentUser->files);
    }

    public static function download(File $file, User $currentUser): FileResource {
        return new FileResource($file);
    }

    public static function delete(File $file): FileDeleteResource {
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
}
