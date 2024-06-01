<?php

namespace Database\Seeders\Permissions;

use App\Utils\Permissions\AllPermissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allPermissions = AllPermissions::get();

        foreach ($allPermissions as $typePermission) {
            $permission = DB::table('permissions')->where('type', $typePermission['type'])->first();

            if ($permission) {
                continue;
            }

            DB::table('permissions')->insert([
                'type' => $typePermission['type'],
                'description' => $typePermission['description'],
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
