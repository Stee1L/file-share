<?php

namespace App\Src\Response;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileDeleteResource extends JsonResource
{
    protected string $randomMessage;

    /**
     * @param string $randomMessage
     */
    public function __construct(string $randomMessage)
    {
        $this->randomMessage = $randomMessage;
    }


    public function toArray(Request $request)
    {
        return [
            'success' => true,
            'message' => $this->randomMessage
        ];
    }

}
