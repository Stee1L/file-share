<?php

namespace App\Src\Response;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id'=>$this->id,
                'name'=>$this->name,
                'roles'=>$this->roles->pluck('name')->toArray()
            ]
        ];
    }
}
