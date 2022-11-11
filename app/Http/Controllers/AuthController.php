<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use \Illuminate\Http\Request;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\AuthResource;
use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        // Validation rules have been moved to RegisterRequest to override failedValidation
        // $attributes = request()->validate([
        //     'name' => 'required',
        //     'username' => ['required', Rule::unique('users', 'username')],
        //     'email' => ['required', 'email', Rule::unique('users', 'email')],
        //     'password' => ['required'],
        // ]);

        // Safe to save the attributes as they've already been validated at this point
        $attributes = $request->validated();
        $user = User::create($attributes);

        // Dispatch Job to send email to new user
        // Any arguments passed to dispatch method would be passed to the constructor of the class (SendWelcomeEmail Job)
        SendWelcomeEmail::dispatch($user);

        // Create a token to be used within Bearer Token to access protected routes
        $user->token = $user->createToken('testTokenKey')->plainTextToken;
        return new AuthResource($user);
    }

    public function login(AuthLoginRequest $request)
    {
        // Find user by username from the database
        $user = User::firstWhere('username', $request->username);

        // Check validity of given username and password if it matches the one in the database
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'type' => 'error',
                'message' => 'bad credentials',
            ], 401);
        }

        // Create a token to be used within Bearer Token to access protected routes
        $user->token = $user->createToken('testTokenKey')->plainTextToken;
        return new AuthResource($user);
    }

    public function logout(Request $request)
    {
        // Delete token of current user within the request
        $request->user()->currentAccessToken()->delete();
        return [
            'type' => 'success',
            'message' => 'logged out',
        ];
    }
}
