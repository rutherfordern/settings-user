<?php

declare(strict_types=1);

namespace App\Factory;

use App\Verification\EmailVerificationSender;
use App\Verification\SmsVerificationSender;
use App\Verification\TelegramVerificationSender;
use App\Verification\VerificationSenderInterface;

class VerificationSenderFactory
{
    public static function createSender(string $verificationMethod): VerificationSenderInterface
    {
        return match ($verificationMethod) {
            'email' => new EmailVerificationSender(),
            'telegram' => new TelegramVerificationSender(),
            'sms' => new SmsVerificationSender(),
        };
    }
}
