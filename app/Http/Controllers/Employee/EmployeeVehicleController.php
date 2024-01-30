<?php

namespace App\Http\Controllers\Employee;

use App\Domain\Employee\Services\EmployeeVehicleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\CreateVehicleRequest;
use App\Http\Requests\Vehicle\ListVehicleRequest;
use App\Http\Requests\Vehicle\ShowRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use Exception;
use Illuminate\Http\JsonResponse;
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

    public function showAction(ShowRequest $request, int $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeVehicleService->show($id);
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

    public function listAction(ListVehicleRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->employeeVehicleService->list(
                $request->input('establishmentId'),
                $request->input('companyId'),
                $request->input('employeeId'),
                $request->input('plate'),
                $request->input('model'),
                $request->input('color'),
                $request->input('price'),
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
            $output = $this->employeeVehicleService->delete($id);
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
