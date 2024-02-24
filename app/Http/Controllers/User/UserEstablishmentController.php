<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserEstablishmentService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserEstablishmentController extends Controller
{
    public function __construct(
        private UserEstablishmentService $userEstablishmentService
    ) {
    }

    public function listestablishmentAction(): JsonResponse
    {
        try {
            $output = $this->userEstablishmentService->listEstablishmentByUser();

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
