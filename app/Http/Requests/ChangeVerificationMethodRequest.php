<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeVerificationMethodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'verification_method' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'verification_method.required' => 'Поле verification_method обязательно для заполнения.',
        ];
    }
}
