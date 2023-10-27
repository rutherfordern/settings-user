<?php

declare(strict_types=1);

namespace App\DTO\User\Update;

class UpdateNicknameDto
{
    public function __construct(
        public readonly int $user_id,
        public readonly string $nickname,
    ) {
    }
}
