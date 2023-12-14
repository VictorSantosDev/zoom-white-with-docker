<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Admin\Services\AdminEstablishmentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateEstablishmentRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminEstablishmentController extends Controller
{
    public function __construct(
        private AdminEstablishmentService $adminEstablishmentService
    ) {
    }

    public function createAction(CreateEstablishmentRequest $request)
    {
        try {
            $output = $this->adminEstablishmentService->create($request->data());

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
