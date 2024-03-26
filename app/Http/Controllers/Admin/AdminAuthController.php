<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Admin\Services\AdminService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function __construct(
        private AdminService $adminService
    ) {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $output = $this->adminService->login(
                $request->input('email'),
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

    public function me(): JsonResponse
    {
        try {
            $output = $this->adminService->me();

            return response()->json([
                'data' => $output
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function logout(): JsonResponse
    {
        try {
            $output = $this->adminService->logout();

            return response()->json([
                'data' => $output
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function refresh(): JsonResponse
    {
        try {
            $output = $this->adminService->refresh();

            return response()->json([
                'data' => $output
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], in_array(
                $e?->getCode(),
                [0, null]
            ) ? JsonResponse::HTTP_UNPROCESSABLE_ENTITY : $e->getCode());
        }
    }
}
