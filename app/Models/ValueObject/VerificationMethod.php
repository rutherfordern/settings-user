<?php

declare(strict_types=1);

namespace App\Models\ValueObject;

use App\Exceptions\InvalidVerificationMethod;

class VerificationMethod
{
    private array $allowedMethods = ['email', 'sms', 'telegram'];

    public function __construct(private readonly string $verificationMethod)
    {
        if (!in_array($verificationMethod, $this->allowedMethods)) {
            throw new InvalidVerificationMethod();
        }
    }

    public function getVerificationMethod(): string
    {
        return $this->verificationMethod;
    }
}
