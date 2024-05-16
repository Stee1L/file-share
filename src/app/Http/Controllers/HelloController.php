<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class HelloController extends Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse(['message'=>'Добро пожаловать к котанам']);
    }
}
