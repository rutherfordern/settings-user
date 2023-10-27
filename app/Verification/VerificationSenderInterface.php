<?php

declare(strict_types=1);

namespace App\Verification;

interface VerificationSenderInterface
{
    public function send($recipient, $verificationCode);
}
