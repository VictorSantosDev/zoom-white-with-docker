<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserWashingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Washing\CreateWashingRequest;
use App\Http\Requests\Washing\ListWashingByEstablishmentRequest;
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
            $output = $this->userWashingService->show($id);

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function listAction(ListWashingByEstablishmentRequest $request)
    {
        try {
            $output = $this->userWashingService->list(
                $request->input('establishmentId'),
                $request->input('name'),
                $request->input('active')
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
            $output = $this->userWashingService->delete($id);

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
