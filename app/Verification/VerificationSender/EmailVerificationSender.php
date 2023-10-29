<?php

declare(strict_types=1);

namespace App\Verification\VerificationSender;

class EmailVerificationSender implements VerificationSenderInterface
{
    public function send($recipient, string $verificationCode)
    {
    }
}
