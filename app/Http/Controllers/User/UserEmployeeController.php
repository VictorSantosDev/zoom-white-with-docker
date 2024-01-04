<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserEmployeeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UserEmployeeController extends Controller
{
    public function __construct(
        private UserEmployeeService $userEmployeeService
    ) {
    }

    public function createEmployeeAction(CreateEmployeeRequest $request): JsonResponse
    {
        try {
            $output = $this->userEmployeeService->createEmployee(
                $request->data(),
                $request->password()
            );

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
