<?php

namespace App\Domain\User\Services;

use App\Domain\Admin\Services\AdminUserService;
use DateTime;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserPasswordService
{
    public function __construct(
        private AdminUserService $adminUserService,
        private UserSendingEmailService $userSendingEmailService
    ) {
    }

    public function forgotPassword(string $email): bool
    {
        $user = $this->adminUserService->findUserByEmail($email);
        $hash = Str::uuid()->toString();

        $this->adminUserService->updateHashPasswordReset($user->getId()?->get(), $hash);
        $this->userSendingEmailService->sendPasswordReset(
            $user,
            $hash
        );

        return true;
    }

    public function newPassword(
        string $hash,
        string $password
    ): bool {
        $user = $this->adminUserService->findUserByHash($hash);

        if (Carbon::now('-1')->format('Y-m-d H:i:s') > $user->getResetExpiration()) {
            throw new Exception('Hash para redefinir a senha já expirou, solicite outra redefinição de senha em "Esqueci minha senha!"');
        }

        $this->adminUserService->updatePassword($user->getId()?->get(), $password);

        return true;
    }

    public function newPasswordLoggedPassword(
        string $oldPassword,
        string $password
    ): bool {
        $user = auth()->user();

        if (!password_verify($oldPassword, $user->password)) {
            throw new Exception('Sua senha atual é inválida, caso não lembre tente fazer a redefinição de senha na tela de login.');
        }

        if ($oldPassword === $password) {
            throw new Exception('Nova senha é igual a senha atual.');
        }

        $this->adminUserService->updatePassword($user->id, $password);

        return true;
    }
}
