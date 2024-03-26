<?php

namespace App\Domain\Employee\Services;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class EmployeeAuthService
{
    public function login(string $registration, string $password): array
    {
        $credentials = [
            'registration' => $registration,
            'password' => $password
        ];

        if (!$token = auth('employee')->attempt($credentials)) {
            throw new Exception('Não autorizado', JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    public function me(): array
    {
        $auth = auth('employee')->user();

        if (!$auth) {
            throw new Exception(
                'Não autorizado, faça o login novamente.',
                JsonResponse::HTTP_UNAUTHORIZED
            );
        }

        return [
            'name' => $auth->name,
            'email' => $auth->email,
            'email_verified_at' => $auth->email_verified_at,
            'created_at' => $auth->created_at,
            'updated_at' => $auth->updated_at
        ];
    }

    public function logout(): array
    {
        auth('employee')->logout();

        return ['message' => 'Deslogado com sucesso!'];
    }

    public function refresh(): array
    {
        try {
            return $this->respondWithToken(auth('employee')->refresh());
        } catch (Exception) {
            throw new Exception(
                'Não autorizado, faça o login novamente.',
                JsonResponse::HTTP_UNAUTHORIZED
            );
        }
    }

    protected function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('employee')->factory()->getTTL() * 60
        ];
    }
}
