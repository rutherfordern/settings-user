<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    public function getById(int $id): ?User
    {
        return User::where('id', $id)->first();
    }
}
