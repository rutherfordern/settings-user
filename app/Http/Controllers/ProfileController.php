<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\User\Update\UpdateNicknameDto;
use App\DTO\User\Update\UpdateVerificationMethodDto;
use App\DTO\UserVerification\Create\CreateUserVerificationDto;
use App\DTO\UserVerification\Update\UpdateVerificationStatusDto;
use App\Factory\VerificationSenderFactory;
use App\Http\Requests\ChangeVerificationMethodRequest;
use App\Http\Requests\VerifyChangeNicknameRequest;
use App\Service\UserService;
use App\Service\UserVerificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function changeNickname(
        UserVerificationService $userVerificationService,
        VerificationSenderFactory $senderFactory
    ): JsonResponse {
        $user = auth()->user();

        $verificationMethod = $user->verification_method;
        $verificationCode = Str::random(6);

        $verificationDto = new CreateUserVerificationDto(
            $user->id,
            $verificationCode,
            $verificationMethod,
            false
        );

        $userVerificationService->create($verificationDto);

        $senderFactory::createSender($verificationMethod);

        return response()->json(['message' => 'Код подтверждения отправлен']);
    }

    public function verifyChangeNickname(
        VerifyChangeNicknameRequest $request,
        UserService $userService,
        UserVerificationService $userVerificationService
    ): JsonResponse {
        $userId = auth()->user()->id;
        $providedCode = $request->validated(['verification_code']);

        $verification = $userVerificationService->findUnverifiedCode($userId, $providedCode);

        if ($verification) {
            $newNickname = $request->validated(['nickname']);

            $updateNicknameDto = new UpdateNicknameDto($userId, $newNickname);
            $userService->updateNickname($updateNicknameDto);

            $updateVerificationStatusDto = new UpdateVerificationStatusDto($verification->id, true);
            $userVerificationService->updateVerificationStatus($updateVerificationStatusDto);

            return response()->json(['message' => 'Nickname успешно изменен']);
        } else {
            return response()->json(['message' => 'Неверный код подтверждения'], 422);
        }
    }

    public function changeVerificationMethod(ChangeVerificationMethodRequest $request, UserService $userService): JsonResponse
    {
        $userId = auth()->user()->id;
        $verificationMethod = $request->validated(['verification_method']);

        $dto = new UpdateVerificationMethodDto($userId, $verificationMethod);

        $userService->updateVerificationMethod($dto);

        return response()->json(['message' => 'Метод верификации успешно обновлен']);
    }
}
