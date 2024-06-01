<?php

namespace App\Src\Response;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FolderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'date_create'=> $this->created_at,
            'last_update' => $this->updated_at,
            'parent'=> [
                'id'=>$this->parent->id,
                'name'=>$this->parent->name
            ]
        ];
    }
}
