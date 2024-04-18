<?php

namespace App\Http\Controllers\Employee;

use App\Domain\Employee\Services\EmployeeAuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginEmployeeRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeAuthController extends Controller
{
    public function __construct(
        private EmployeeAuthService $employeeAuthService
    ) {
    }

    public function login(LoginEmployeeRequest $request): JsonResponse
    {
        try {
            $output = $this->employeeAuthService->login(
                $request->input('registration'),
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
            $output = $this->employeeAuthService->me();

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
            $output = $this->employeeAuthService->logout();

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
            $output = $this->employeeAuthService->refresh();

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
