<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserWashingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Washing\CreateWashingRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UserWashingController extends Controller
{
    public function __construct(
        private UserWashingService $userWashingService
    ) {
    }

    public function createAction(CreateWashingRequest $request): JsonResponse
    {
        try {
            $output = $this->userWashingService->create($request->data());

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
