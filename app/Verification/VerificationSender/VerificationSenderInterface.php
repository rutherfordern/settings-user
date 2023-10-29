<?php

declare(strict_types=1);

namespace App\Verification\VerificationSender;

interface VerificationSenderInterface
{
    public function send($recipient, string $verificationCode);
}
