<?php

declare(strict_types=1);

namespace App\Verification;

class SmsVerificationSender implements VerificationSenderInterface
{
    public function send($recipient, $verificationCode)
    {
    }
}
