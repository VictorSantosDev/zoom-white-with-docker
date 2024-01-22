<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserCategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\ListCategoryRequest;
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

    public function listAction(ListCategoryRequest $request)
    {
        try {
            $output = $this->userCategoryService->list(
                $request->input('establishmentId'),
                $request->input('name', null)
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

    public function deleteAction(int $id): JsonResponse
    {
        try {
            $output = $this->userCategoryService->delete($id);

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
