<?php

namespace App\Http\Controllers;

use App\Enums\GenderType;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Validators\UserCreationValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function register(UserCreationValidator $request)
    {
        $name = $request->get('name');
        $gender = GenderType::from($request->get('gender'))->value;
        $birthday = $request->get('birthday');
        $email = $request->get('email');
        $password = $request->get('password');

        $user = User::create([
            'name' => $name,
            'gender' => $gender,
            'birthday' => $birthday,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => Carbon::now('utc'),
        ]);

        return $this->response(new UserResource($user));
    }
}
