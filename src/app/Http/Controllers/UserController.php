<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Src\Request\LoginRequest;
use App\Src\Request\UpdateRoleUser;
use App\Src\Request\UserRequest;
use App\Src\Response\LoginResource;
use App\Src\Response\UserResource;
use App\Src\Services\UserService;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    public function login(LoginRequest $request): LoginResource
    {
        return UserService::createToken($request);
    }

    public function create(UserRequest $request): UserResource
    {
        $this->authorize('create', User::class);
        return UserService::createUser($request);
    }

    public function update(User $user, UpdateRoleUser $roleUser): UserResource {
        $this->authorize('update', $user);
        $user->roles()->detach($user->roles->pluck('id'));
        $user->roles()->attach(Role::where('name', $roleUser->name)->first());
        $user->refresh();
        return new UserResource($user);
    }

    public function all()
    {
        $this->authorize('viewAny', User::class);
        return UserResource::collection(User::all());
    }

}
