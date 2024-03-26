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

    public function showAction(int $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeWashingVehicle->show($id);
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
                $request->input('establishmentId'),
                $request->input('employeeId', null),
                $request->input('plate', null),
                $request->input('model', null),
                $request->input('color', null),
                $request->input('price', null),
                $request->input('limitPerPage', 10)
            );
            DB::commit();
            return response()->json([
                'data' => $output
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function deleteAction(int $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeWashingVehicle->delete($id);
            DB::commit();
            return response()->json([
                'data' => $output
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
