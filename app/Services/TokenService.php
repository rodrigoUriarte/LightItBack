<?php
namespace App\Services;

use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TokenService
{
    public function createFromUserToken(User $user,string $token): Token
    {
        return Token::updateOrCreate(
            ['user_id' => $user->id],
            [
                'token' => $token,
                'expires_at' => Carbon::now('utc')->addDay(),
            ]
        );
    }
}
