<?php

namespace App\Domain\User\Services;

use Exception;
use Illuminate\Http\JsonResponse;

class UserService
{
    public function login(string $email, string $password): array
    {
        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        if (!$token = auth('users')->attempt($credentials)) {
            throw new Exception('Não autorizado', JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    public function me(): array
    {
        $auth = auth('users')->user();

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
        auth('users')->logout();

        return ['message' => 'Deslogado com sucesso!'];
    }

    public function refresh(): array
    {
        try {
            return $this->respondWithToken(auth('users')->refresh());
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
            'expires_in' => auth('users')->factory()->getTTL() * 60,
            'user' => base64_encode(json_encode(auth('users')->user()->toArray())),
        ];
    }
}
