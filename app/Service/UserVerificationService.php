<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\UserVerification\Create\CreateUserVerificationDto;
use App\DTO\UserVerification\Update\UpdateVerificationStatusDto;
use App\Models\UserVerification;
use App\Repository\UserVerificationRepository;

class UserVerificationService
{
    public function __construct(private UserVerificationRepository $userVerificationRepository)
    {
    }

    public function create(CreateUserVerificationDto $createUserVerificationDto): void
    {
        $userVerification = new UserVerification();

        $userVerification->user_id = $createUserVerificationDto->user_id;
        $userVerification->verification_code = $createUserVerificationDto->verification_code;
        $userVerification->verification_method = $createUserVerificationDto->verification_method;
        $userVerification->verified = $createUserVerificationDto->verified;

        $userVerification->save();
    }

    public function findUnverifiedCode(int $userId, string $providedCode): ?UserVerification
    {
        return $this->userVerificationRepository->getUnverifiedCode($userId, $providedCode);
    }

    public function updateVerificationStatus(UpdateVerificationStatusDto $dto): void
    {
        $userVerification = $this->userVerificationRepository->getById($dto->verification_id);

        $userVerification->verified = $dto->verified;

        $userVerification->save();
    }
}
