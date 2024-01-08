<?php

namespace App\Http\Controllers\Employee;

use App\Domain\Employee\Services\EmployeeWashingVehicleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\WashingVehicle\CreateWashingVehicleRequest;
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

    public function createAction(CreateWashingVehicleRequest $request)
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
}
