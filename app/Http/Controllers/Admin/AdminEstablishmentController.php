<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Admin\Services\AdminEstablishmentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateEstablishmentRequest;
use App\Http\Requests\Admin\ListEstablishmentByUserRequest;
use App\Http\Requests\Admin\UpdateEstablishmentRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminEstablishmentController extends Controller
{
    public function __construct(
        private AdminEstablishmentService $adminEstablishmentService
    ) {
    }

    public function createAction(CreateEstablishmentRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->adminEstablishmentService->create(
                $request->dataEstablishment(),
                $request->dataAddress(),
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

    public function updateAction(UpdateEstablishmentRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->adminEstablishmentService->update(
                $request->dataEstablishment(),
                $request->dataAddress(),
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

    public function listByUserAction(ListEstablishmentByUserRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->adminEstablishmentService->listByUserId(
                $request->input('userId'),
                $request->input('nameByCompany'),
                $request->input('document'),
                $request->input('type')
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

    public function showAction(int $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->adminEstablishmentService->show($id);

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
            $output = $this->adminEstablishmentService->delete($id);

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
