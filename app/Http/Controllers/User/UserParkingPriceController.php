<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserParkingPriceService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Parking\CreateParkingPriceRequest;
use App\Http\Requests\Parking\ShowParkingRequest;
use App\Http\Requests\Parking\UpdateParkinPriceRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserParkingPriceController extends Controller
{
    public function __construct(
        private UserParkingPriceService $userParkingPriceService
    ) {
    }

    public function createParkingPriceAction(CreateParkingPriceRequest $request): JsonResponse
    {
        try {
            $output = $this->userParkingPriceService->createParkingPrice($request->data());

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function updateParkingPriceAction(UpdateParkinPriceRequest $request): JsonResponse
    {
        try {
            $output = $this->userParkingPriceService->updateParkingPrice($request->data());

            return response()->json([
                'data' => $output->jsonSerialize()
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function showParkingPriceAction(ShowParkingRequest $request, int $id): JsonResponse
    {
        try {
            $output = $this->userParkingPriceService->showParkingPrice($id);

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
