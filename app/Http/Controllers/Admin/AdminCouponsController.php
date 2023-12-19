<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Admin\Services\AdminCuponsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCouponsRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminCouponsController extends Controller
{
    public function __construct(
        private AdminCuponsService $adminCuponsService
    ) {
    }

    public function createAction(CreateCouponsRequest $createCouponsRequest): JsonResponse
    {
        try {
            $output = $this->adminCuponsService->create($createCouponsRequest->data());

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function updateAction(): JsonResponse
    {
        try {
            $output = $this->adminCuponsService->update();

            return response()->json([
                'data' => $output
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function showAction(): JsonResponse
    {
        try {
            $output = $this->adminCuponsService->show();

            return response()->json([
                'data' => $output
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
            $output = $this->adminCuponsService->delete();

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
