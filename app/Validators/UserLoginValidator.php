<?php
namespace App\Validators;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginValidator extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }
}
