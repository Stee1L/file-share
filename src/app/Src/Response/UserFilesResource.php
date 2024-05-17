<?php

namespace App\Src\Response;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFilesResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            ''
        ];
    }

}
