<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class APIAuthController extends Controller
{
    public function register(Request $request)
    {

        $this->authorize('create', User::class);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],

        ]);

        // 1
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        // 2
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user->roles()->save(Role::find(2));

        // 3
        $token = $user->createToken(rand())->plainTextToken;



        // 4
        return response()->json(['token' => $token], 200);
    }

    public function token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],

        ]);

        // 1
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        // 2
        $user = User::where('email', $request->email)->first();

        // 3
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
        }

        // 4
        return response()->json(['token' => $user->createToken(rand())->plainTextToken]);
    }
}
