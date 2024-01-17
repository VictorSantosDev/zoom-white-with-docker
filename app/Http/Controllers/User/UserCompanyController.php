<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserCompanyService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateCompanyRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserCompanyController extends Controller
{
    public function __construct(
        private UserCompanyService $userCompanyService
    ) {
    }

    public function createAction(CreateCompanyRequest $request): JsonResponse
    {
        try {
            $output = $this->userCompanyService->create(
                $request->dataCompany(),
                $request->dataAddress()
            );

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function updateAction(Request $request): JsonResponse
    {
        try {
            $output = $this->userCompanyService->update($request->data());

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

    public function listAction(Request $request): JsonResponse
    {
        try {
            $output = $this->userCompanyService->list($request->all());

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function deleteAction(int $id): JsonResponse
    {
        try {
            $output = $this->userCompanyService->delete($id);

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
