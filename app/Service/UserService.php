<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\User\Update\UpdateNicknameDto;
use App\DTO\User\Update\UpdateVerificationMethodDto;
use App\Models\ValueObject\VerificationMethod;
use App\Repository\UserRepository;

class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function updateNickname(UpdateNicknameDto $dto): void
    {
        $user = $this->userRepository->getById($dto->user_id);

        $user->nickname = $dto->nickname;

        $user->save();
    }

    public function updateVerificationMethod(UpdateVerificationMethodDto $dto): void
    {
        $user = $this->userRepository->getById($dto->user_id);
        $verificationMethod = new VerificationMethod($dto->verificationMethod);

        $user->verification_method = $verificationMethod->getVerificationMethod();

        $user->save();
    }
}
