<?php

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserParkingPriceService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Parking\CreateParkingPriceRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UserParkingPriceController extends Controller
{
    public function __construct(
        private UserParkingPriceService $userParkingPriceService
    ) {
    }

    public function createParkingPriceAction(CreateParkingPriceRequest $request)
    {
        try {
            $output = $this->userParkingPriceService->createParkingPrice($request->data());

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
