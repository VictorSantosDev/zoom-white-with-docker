<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Admin\Services\AdminCouponsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCouponsRequest;
use App\Http\Requests\Admin\EnableOrDisableCouponsRequest;
use App\Http\Requests\Admin\UpdateCouponRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminCouponsController extends Controller
{
    public function __construct(
        private AdminCouponsService $adminCuponsService
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

    public function updateAction(UpdateCouponRequest $request): JsonResponse
    {
        try {
            $output = $this->adminCuponsService->update($request->data());

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
            $output = $this->adminCuponsService->show($id);

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function enableOrDisableAction(EnableOrDisableCouponsRequest $request): JsonResponse
    {
        try {
            $output = $this->adminCuponsService->enableOrDisable(
                $request->input('couponsId'),
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
}
