<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Admin\Services\AdminUserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function __construct(
        private AdminUserService $adminUserService
    ) {
    }

    public function createAction(CreateUserRequest $request): JsonResponse
    {
        try {
            $output = $this->adminUserService->create($request->data());

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
