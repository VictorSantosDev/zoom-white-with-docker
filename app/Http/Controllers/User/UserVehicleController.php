<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserVehicleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\CreateVehicleRequest;
use App\Http\Requests\Vehicle\DeleteVehicleRequest;
use App\Http\Requests\Vehicle\ListVehicleRequest;
use App\Http\Requests\Vehicle\ShowVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserVehicleController extends Controller
{
    public function __construct(
        private UserVehicleService $userVehicleService
    ) {
    }

    public function createAction(CreateVehicleRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->userVehicleService->create(
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
            $output = $this->userVehicleService->update(
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

    public function showAction(ShowVehicleRequest $request, int $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->userVehicleService->show($id);
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
            $output = $this->userVehicleService->list(
                $request->input('establishmentId'),
                $request->input('companyId'),
                $request->input('userId'),
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

    public function deleteAction(DeleteVehicleRequest $request, int $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->userVehicleService->delete($id);
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
