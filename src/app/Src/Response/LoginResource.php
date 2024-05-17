<?php

namespace App\Src\Response;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    protected string $token;
    public function __construct($resource, $token)
    {
        parent::__construct($resource);
        $this->token = $token;
    }

    public function toArray(Request $request): array
    {
        return [
            'user_data' => [
                'id'=>$this->id,
                'name'=>$this->name,
                'roles'=>$this->roles->pluck('name')->toArray()
            ],
            'token'=> $this->token
        ];
    }


}
