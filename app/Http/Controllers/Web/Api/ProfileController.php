<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Api;

use App\DTO\User\Update\UpdateNicknameDto;
use App\DTO\User\Update\UpdateVerificationMethodDto;
use App\DTO\UserVerification\Create\CreateUserVerificationDto;
use App\DTO\UserVerification\Update\UpdateVerificationStatusDto;
use App\Factory\VerificationSenderFactory;
use App\Http\Requests\ChangeVerificationMethodRequest;
use App\Http\Requests\VerifyChangeNicknameRequest;
use App\Service\UserService;
use App\Service\UserVerificationService;
use App\Verification\VerificationCodeGenerator\VerificationCodeGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    public function __construct(
        private UserVerificationService $userVerificationService,
        private UserService $userService,
    ) {
    }

    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function changeNickname(
        VerificationSenderFactory $senderFactory,
        VerificationCodeGenerator $codeGenerator
    ): JsonResponse {
        $user = auth()->user();

        $verificationMethod = $user->verification_method;
        $verificationCode = $codeGenerator->generate();

        $verificationDto = new CreateUserVerificationDto(
            $user->id,
            $verificationCode,
            $verificationMethod,
            false
        );

        $this->userVerificationService->create($verificationDto);

        $sender = $senderFactory->createSender($verificationMethod);
        $sender->send($user, $verificationCode);

        return response()->json(['message' => 'Код подтверждения отправлен']);
    }

    public function verifyChangeNickname(VerifyChangeNicknameRequest $request): JsonResponse
    {
        $userId = auth()->user()->id;
        $providedCode = $request->validated(['verification_code']);

        $verification = $this->userVerificationService->findUnverifiedCode($userId, $providedCode);

        if ($verification) {
            $newNickname = $request->validated(['nickname']);

            $updateNicknameDto = new UpdateNicknameDto($userId, $newNickname);
            $this->userService->updateNickname($updateNicknameDto);

            $updateVerificationStatusDto = new UpdateVerificationStatusDto($verification->id, true);
            $this->userVerificationService->updateVerificationStatus($updateVerificationStatusDto);

            return response()->json(['message' => 'Nickname успешно изменен']);
        } else {
            return response()->json(['message' => 'Неверный код подтверждения'], 422);
        }
    }

    public function changeVerificationMethod(ChangeVerificationMethodRequest $request): JsonResponse
    {
        $userId = auth()->user()->id;
        $verificationMethod = $request->validated(['verification_method']);

        $dto = new UpdateVerificationMethodDto($userId, $verificationMethod);

        $this->userService->updateVerificationMethod($dto);

        return response()->json(['message' => 'Метод верификации успешно обновлен']);
    }
}
