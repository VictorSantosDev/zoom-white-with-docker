<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserServiceByCategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ListServiceRequest;
use App\Http\Requests\Service\ServiceRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserServiceController extends Controller
{
    public function __construct(
        private UserServiceByCategoryService $userServiceByCategoryService
    ) {
    }

    public function createAction(ServiceRequest $request): JsonResponse
    {
        try {
            $output = $this->userServiceByCategoryService->create($request->data());

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
            $output = $this->userServiceByCategoryService->show($id);

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function listAction(ListServiceRequest $request): JsonResponse
    {
        try {
            $output = $this->userServiceByCategoryService->list(
                $request->input('establishmentId'),
                $request->input('name', null),
                $request->input('price', null),
                $request->input('limitPerPage', 10)
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
            $output = $this->userServiceByCategoryService->delete($id);

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
