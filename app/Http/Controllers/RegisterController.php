<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
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
        User::create($attributes);
        return [
            'type' => 'success',
            'message' => 'Account successfully created.'
        ];
    }
}
