<?php

namespace App\Http\Controllers\Employee;

use App\Domain\Employee\Services\EmployeeVehicleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\CreateVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeVehicleController extends Controller
{
    public function __construct(
        private EmployeeVehicleService $employeeVehicleService
    ) {
    }

    public function createAction(CreateVehicleRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeVehicleService->create(
                $request->data(),
                $request->input('serviceIds', [])
            );
            DB::commit();
            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function updateAction(UpdateVehicleRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeVehicleService->update(
                $request->data(),
                $request->input('serviceIds', [])
            );
            DB::commit();
            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function showAction(): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeVehicleService->create(
                $request->input('estableshimentId'),
                $request->input('washingIds'),
                $request->input('plate'),
                $request->input('model'),
                $request->input('color')
            );
            DB::commit();
            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function listAction(): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeVehicleService->create(
                $request->input('estableshimentId'),
                $request->input('washingIds'),
                $request->input('plate'),
                $request->input('model'),
                $request->input('color')
            );
            DB::commit();
            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function deleteAction(): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeVehicleService->create(
                $request->input('estableshimentId'),
                $request->input('washingIds'),
                $request->input('plate'),
                $request->input('model'),
                $request->input('color')
            );
            DB::commit();
            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
