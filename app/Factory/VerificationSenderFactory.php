<?php

declare(strict_types=1);

namespace App\Factory;

use App\Exceptions\InvalidVerificationMethod;
use App\Verification\VerificationSender\EmailVerificationSender;
use App\Verification\VerificationSender\SmsVerificationSender;
use App\Verification\VerificationSender\TelegramVerificationSender;
use App\Verification\VerificationSender\VerificationSenderInterface;

class VerificationSenderFactory
{
    public function createSender(string $verificationMethod): VerificationSenderInterface
    {
        return match ($verificationMethod) {
            'email' => new EmailVerificationSender(),
            'telegram' => new TelegramVerificationSender(),
            'sms' => new SmsVerificationSender(),
            default => throw new InvalidVerificationMethod(),
        };
    }
}
