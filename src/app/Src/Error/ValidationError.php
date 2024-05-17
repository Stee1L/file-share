<?php
namespace App\Src\Error;
class ValidationError extends APIError
{
    public function __construct($code = 422, $message = 'Ошибка валидации', $errors = [])
    {
        parent::__construct($code, $message, $errors);
    }
}
