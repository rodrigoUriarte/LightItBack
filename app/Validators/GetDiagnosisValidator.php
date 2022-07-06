<?php

namespace App\Validators;

use App\Enums\GenderType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class GetDiagnosisValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'symptoms' => ['required', 'array'],
            'gender' => ['required', 'string', new Enum(GenderType::class)],
            'birthday' => ['required', 'string', 'date_format:Y-m-d'],
        ];
    }
}
