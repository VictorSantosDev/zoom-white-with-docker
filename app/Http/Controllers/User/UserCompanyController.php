<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserCompanyService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\DeleteCompanyRequest;
use App\Http\Requests\Company\ListCompanyRequest;
use App\Http\Requests\Company\ShowCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCompanyController extends Controller
{
    public function __construct(
        private UserCompanyService $userCompanyService
    ) {
    }

    public function createAction(CreateCompanyRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->userCompanyService->create(
                $request->dataCompany(),
                $request->dataAddress()
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

    public function updateAction(UpdateCompanyRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $output = $this->userCompanyService->update(
                $request->dataCompany(),
                $request->dataAddress()
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

    public function showAction(ShowCompanyRequest $request, int $id): JsonResponse
    {
        try {
            $output = $this->userCompanyService->show($id);

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function listAction(ListCompanyRequest $request): JsonResponse
    {
        try {
            $output = $this->userCompanyService->list(
                $request->input('establishmentId'),
                $request->input('companyName', null),
                $request->input('fantasyName', null),
                $request->input('document', null),
                $request->input('phone', null),
                $request->input('email', null),
                $request->input('limitPerPage', 10)
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

    public function deleteAction(DeleteCompanyRequest $request, int $id): JsonResponse
    {
        try {
            $output = $this->userCompanyService->delete($id);

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
