<?php

namespace App\Src\Response;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileMoveResponse extends JsonResource
{
    public function toArray(Request $request)
    {
        $folder = $this->folder;
        return [
            'file_id'=>$this->id,
            'file_name'=>$this->original_name,
            'folder_data'=>[
                'id'=>$folder->id,
                'name'=>$folder->name,
            ]
        ];
    }

}
