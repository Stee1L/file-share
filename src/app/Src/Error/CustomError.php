<?php

namespace App\Src\Error;

use App\Src\Error\APIError;

class CustomError extends APIError
{

    public function __construct($code = 400, $message = 'Ошибка', $errors = [])
    {
        parent::__construct($code, $message, $errors);
    }
}
