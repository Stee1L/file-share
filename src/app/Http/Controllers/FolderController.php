<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Src\Request\FileRequest;
use Illuminate\Routing\Controller;

class FolderController extends Controller
{
    public function create(FileRequest $request) {
        return Folder::create($request, auth()->user());
    }
}
