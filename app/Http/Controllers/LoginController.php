<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\TokenService;
use App\Validators\UserLoginValidator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @var TokenService
     */
    protected $token;

    public function __construct(TokenService $token)
    {
        $this->token = $token;
    }
    public function login(UserLoginValidator $request)
    {

        $credentials = $request->only('email', 'password');

        if (false === Auth::attempt($credentials)) {
            return response()->json([
                'metadata' => [
                    'code' => 401,
                    'message' => 'These credentials do not match our records.'
                ],
                'data' => [],
            ]);

        }

        $user = Auth::user();
        $user->setRelation(
            'token',
            $this->token->createFromUser($user)
        );

        return $this->response(new UserResource($user));
    }
}
