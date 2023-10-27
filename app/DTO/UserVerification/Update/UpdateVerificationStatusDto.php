<?php

declare(strict_types=1);

namespace App\DTO\UserVerification\Update;

class UpdateVerificationStatusDto
{
    public function __construct(
        public readonly int $verification_id,
        public readonly bool $verified,
    ) {
    }
}
