<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        return response()->json(
            ["id"=>$user->id,
                "name"=>$user->name,
                "email"=>$user->email,
                "Дата регистрации"=>$user->created_at,
                "Роль"=>$user->roles->first()->name,
                "Харак"=>$user->roles->first()->slug,
            ]
        );
    }


}
