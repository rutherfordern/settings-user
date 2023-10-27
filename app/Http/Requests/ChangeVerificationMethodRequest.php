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
            'verification_method' => 'required|in:email,sms,telegram',
        ];
    }

    public function messages(): array
    {
        return [
            'verification_method.required' => 'Поле "Метод верификации" обязательно для заполнения.',
            'verification_method.in' => 'Поле "Метод верификации" должно быть одним из следующих значений: email, sms, telegram.',
        ];
    }
}
