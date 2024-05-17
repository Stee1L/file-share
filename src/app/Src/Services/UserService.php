<?php

namespace App\Src\Services;

use App\Models\Role;
use App\Models\User;
use App\Src\Constant\RoleConstant;
use App\Src\Error\CustomError;
use App\Src\Request\LoginRequest;
use App\Src\Request\UserRequest;
use App\Src\Response\LoginResource;
use App\Src\Response\UserResource;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function createUser(UserRequest $request): UserResource
    {
        $request->password = Hash::make($request->password);

        $createUser = User::create($request->all());

        $createUser->roles()
            ->sync(Role::where('name', RoleConstant::USER)->first());

        //TODO: Add create root folder
        return new UserResource($createUser);
    }

    public static function createToken(LoginRequest $request): LoginResource {
        $foundUser = User::where('email', $request->email)->first();
        if (!$foundUser || !Hash::check($request->password, $foundUser->password)) {
            throw new CustomError(403, 'Неверные данные для входа');
        }

        $token = $foundUser->createToken(rand())->plainTextToken;

        return new LoginResource($foundUser, $token);
    }


}
