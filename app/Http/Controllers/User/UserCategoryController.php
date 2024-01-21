<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserCategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UserCategoryController extends Controller
{
    public function __construct(
        private UserCategoryService $userCategoryService
    ) {
    }

    public function createAction(CreateCategoryRequest $request): JsonResponse
    {
        try {
            $output = $this->userCategoryService->create($request->data());

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function updateAction(UpdateCategoryRequest $request): JsonResponse
    {
        try {
            $output = $this->userCategoryService->update($request->data());

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function showAction(int $id): JsonResponse
    {
        try {
            $output = $this->userCategoryService->show($id);

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function deleteAction(): JsonResponse
    {
        try {
            $output = $this->userCategoryService->login(
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
}
