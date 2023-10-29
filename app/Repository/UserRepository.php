<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    public function getById(int $userId): ?User
    {
        return User::where('id', $userId)->first();
    }
}
