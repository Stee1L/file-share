<?php
namespace App\Src\Error;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class APIError extends HttpResponseException
{

    public function __construct($code = 400, $message = 'Что-то пошло не так.', $errors = [])
    {
        $data = [
            'error' => [
                'message' => $message,
            ],
        ];
        if (count($errors) > 0) {
            $data['error']['errors'] = $errors;
        }
        parent::__construct(response()->json($data)->setStatusCode($code));
    }
}
