<?php

namespace App\Src\Response;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $folder = $this->folder;
        return [
            'id'=>$this->id,
            'file_name'=>$this->original_name,
            'date_create'=> $this->created_at,
            'last_update' => $this->updated_at,
            'folder_data'=>[
                'id'=>$folder->id,
                'name'=>$folder->name,
            ]
        ];
    }
}
