<?php

namespace App\Utils\Permissions;

use Illuminate\Support\Collection;

class CollectionPermissionsForUser
{
    static public function ADMIN(): Collection
    {
        return collect([
            'api_create_category',
            'api_update_category',
            'api_show_category',
            'api_list_category',
            'api_delete_category',
            'api_create_service',
            'api_show_service',
            'api_list_service',
            'api_delete_service',
            'api_create_parking_price',
            'api_update_parking_price',
            'api_show_parking_price',
            'api_create_company',
            'api_update_company',
            'api_show_company',
            'api_list_company',
            'api_delete_company',
            'api_create_vehicle',
            'api_update_vehicle',
            'api_show_vehicle',
            'api_list_vehicle',
            'api_delete_vehicle',
            'api_list_establishment_user',
            'api_update_password_logged',
        ]);
    }

    static public function USER(): Collection
    {
        return collect([
            'api_create_category',
            'api_update_category',
            'api_show_category',
            'api_list_category',
            'api_delete_category',
            'api_create_service',
            'api_show_service',
            'api_list_service',
            'api_delete_service',
            'api_create_parking_price',
            'api_update_parking_price',
            'api_show_parking_price',
            'api_create_company',
            'api_update_company',
            'api_show_company',
            'api_list_company',
            'api_delete_company',
            'api_create_vehicle',
            'api_update_vehicle',
            'api_show_vehicle',
            'api_list_vehicle',
            'api_delete_vehicle',
            'api_list_establishment_user',
            'api_update_password_logged',
        ]);
    }

    static public function EMPLOYEE(): Collection
    {
        return collect([
            'api_create_vehicle',
            'api_update_vehicle',
            'api_show_vehicle',
            'api_list_vehicle',
            'api_delete_vehicle',
            'api_update_password_logged',
        ]);
    }
}
