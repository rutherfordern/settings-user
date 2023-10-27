<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\UserVerification;

class UserVerificationRepository
{
    public function getById(int $id): ?UserVerification
    {
        return UserVerification::where('id', $id)->first();
    }

    public function getUnverifiedCode(int $userId, string $providedCode): ?UserVerification
    {
        return UserVerification::where('user_id', $userId)
            ->where('verification_code', $providedCode)
            ->where('verified', false)
            ->first();
    }
}
