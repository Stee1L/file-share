<?php

namespace App\Src\Services;

use App\Models\Folder;
use App\Models\User;
use App\Src\Request\FolderRequest;
use App\Src\Response\FolderResource;

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
}
