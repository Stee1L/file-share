<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Src\Request\FolderRequest;
use App\Src\Response\FolderResource;
use App\Src\Services\FolderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class FolderController extends Controller
{
    public function create(FolderRequest $request): FolderResource
    {
        return FolderService::createFolder($request, auth()->user());
    }

    public function delete(Folder $folder): JsonResponse {
        $res = FolderService::delete($folder);
        return response()->json([
            'delete_files'=> $res
        ]);
    }
}
