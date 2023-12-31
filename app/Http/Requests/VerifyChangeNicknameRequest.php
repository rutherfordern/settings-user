<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyChangeNicknameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nickname' => 'required|string|max:15',
            'verification_code' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nickname.required' => 'Поле nickname обязательно для заполнения.',
            'nickname.max' => 'Поле nickname не должно превышать :max символов.',
            'verification_code.required' => 'Поле verification_method обязательно для заполнения.',
        ];
    }
}
