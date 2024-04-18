<?php

namespace App\Console\Commands;

use App\Domain\Permissions\Services\AssignPermissionToUserService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AssignPermissionToUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:assign-permission-to-user-command {email} {typeUser}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command assign permission to user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            /** @var AssignPermissionToUserService $assignPermissionToUserService */
            $assignPermissionToUserService = resolve(AssignPermissionToUserService::class);
            $email = (string) $this->argument('email');
            $typeUser = (string) $this->argument('typeUser');

            $assignPermissionToUserService->setPermissionForUser(
                $email,
                $typeUser,
                $this->output
            );

            echo "\033[92mPermissões de $typeUser Criado para o Usuário pertencente ao EMAIL:$email\033[0m\n";

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            echo "\033[0;31m$message\033[0m\n";
        }
    }
}
