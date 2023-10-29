<?php

declare(strict_types=1);

namespace App\Verification\VerificationSender;

class SmsVerificationSender implements VerificationSenderInterface
{
    public function send($recipient, string $verificationCode)
    {
    }
}
