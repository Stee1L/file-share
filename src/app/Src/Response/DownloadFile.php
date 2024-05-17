<?php

namespace App\Src\Response;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DownloadFile extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'url' =>Storage::disk('public')->url($this->path),
        ];
    }

}
