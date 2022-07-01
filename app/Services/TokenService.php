<?php
namespace App\Services;

use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TokenService
{
    public function createFromUser(User $user): Token
    {
        return Token::updateOrCreate(
            ['user_id' => $user->id],
            [
                'token' => uniqid(base64_encode(Str::random(60))),
                'expires_at' => Carbon::now('utc')->addDay(),
            ]
        );
    }
}
