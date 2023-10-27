<?php

declare(strict_types=1);

namespace App\DTO\UserVerification\Create;

class CreateUserVerificationDto
{
    public function __construct(
        public readonly int $user_id,
        public readonly string $verification_code,
        public readonly string $verification_method,
        public readonly bool $verified,
    ) {
    }
}
