<?php
namespace App\Validators;

use App\Enums\GenderType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UserCreationValidator extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'gender' => ['required', 'string', new Enum(GenderType::class)],
            'birthday' => ['required', 'string', 'date_format:Y-m-d'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
                'max:150',
            ],
            'password' => ['required', 'string', 'max:50'],
        ];
    }
}
