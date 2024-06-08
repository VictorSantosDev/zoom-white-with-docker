<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserPasswordService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Password\ForgotPasswordRequest;
use App\Http\Requests\Password\NewPasswordLoggedRequest;
use App\Http\Requests\Password\NewPasswordRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UserPasswordController extends Controller
{
    public function __construct(
        private UserPasswordService $userPasswordService
    ) {
    }

    public function newPasswordAction(NewPasswordRequest $request)
    {
        try {

            $output = $this->userPasswordService->newPassword(
                $request->input('hash'),
                $request->input('password')
            );

            return response()->json([
                'data' => $output
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function forgotPasswordAction(ForgotPasswordRequest $request)
    {
        try {
            $output = $this->userPasswordService->forgotPassword($request->input('email'));

            return response()->json([
                'data' => $output
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function newPasswordLoggedAction(NewPasswordLoggedRequest $request)
    {
        try {
            $output = $this->userPasswordService->newPasswordLoggedPassword(
                $request->input('oldPassword'),
                $request->input('password')
            );

            return response()->json([
                'data' => $output
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
