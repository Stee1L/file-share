<?php

namespace App\Traits;

use App\Src\Error\ValidationError;
use Illuminate\Contracts\Validation\Validator;

trait ValidationErr
{
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationError(message: $validator->errors()->all());
    }
}
