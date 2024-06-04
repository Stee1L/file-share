<?php

namespace App\Src\Response;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovedFileResponse extends JsonResource
{
    public function toArray(Request $request)
    {
        $folder = $this->folder;
        return [
          'file_data'=>[
              'id'=>$this->id,
              'name'=>$this->original_name
          ],
            'new_folder'=>[
                'id'=>$folder->id,
                'name'=>$folder->name
            ]
        ];
    }

}
