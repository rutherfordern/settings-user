<?php

declare(strict_types=1);

namespace App\Verification\VerificationSender;

class TelegramVerificationSender implements VerificationSenderInterface
{
    public function send($recipient, string $verificationCode)
    {
    }
}
