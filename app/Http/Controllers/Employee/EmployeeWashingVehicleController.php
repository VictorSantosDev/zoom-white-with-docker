<?php

namespace App\Http\Controllers\Employee;

use App\Domain\Employee\Services\EmployeeWashingVehicleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\WashingVehicle\CreateWashingVehicleRequest;
use App\Http\Requests\WashingVehicle\ListWashingVehiclesRequest;
use App\Http\Requests\WashingVehicle\UpdateWashingVehicleRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeWashingVehicleController extends Controller
{
    public function __construct(
        private EmployeeWashingVehicleService $employeeWashingVehicle
    ) {
    }

    public function createAction(CreateWashingVehicleRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeWashingVehicle->create(
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

    public function updateAction(UpdateWashingVehicleRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeWashingVehicle->update(
                $request->input('washingVehicleId'),
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

    public function showAction(int $washingVehicleId): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeWashingVehicle->show($washingVehicleId);
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

    public function listAction(ListWashingVehiclesRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeWashingVehicle->listAction(
                $this->input('establishmentId'),
                $this->input('employeeId', null),
                $this->input('plate', null),
                $this->input('model', null),
                $this->input('color', null),
                $this->input('price', null),
                $this->input('limitPerPage', 10)
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
