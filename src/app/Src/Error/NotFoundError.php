<?php
namespace App\Src\Error;
class NotFoundError extends APIError
{
    public function __construct($code = 404, $message = 'Page not found')
    {
        parent::__construct($code, $message);
    }
}
