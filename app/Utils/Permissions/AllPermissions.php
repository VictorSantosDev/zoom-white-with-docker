<?php

namespace App\Utils\Permissions;

class AllPermissions
{
    static public function get(): array
    {
        return [
            [
                'type' => 'api_create_category',
                'description' => 'Criar categoria'
            ],
            [
                'type' => 'api_update_category',
                'description' => 'Atualizar categoria'
            ],
            [
                'type' => 'api_show_category',
                'description' => 'Buscar uma categoria'
            ],
            [
                'type' => 'api_list_category',
                'description' => 'Listar categorias'
            ],
            [
                'type' => 'api_delete_category',
                'description' => 'Deletar categorias'
            ],
            [
                'type' => 'api_create_service',
                'description' => 'Criar serviço'
            ],
            [
                'type' => 'api_show_service',
                'description' => 'Buscar serviço'
            ],
            [
                'type' => 'api_list_service',
                'description' => 'Listar serviços'
            ],
            [
                'type' => 'api_delete_service',
                'description' => 'Deletar Serviços'
            ],
            [
                'type' => 'api_create_parking_price',
                'description' => 'Criar preço de estacionamento'
            ],
            [
                'type' => 'api_update_parking_price',
                'description' => 'Atualizar preço de estacionamento'
            ],
            [
                'type' => 'api_show_parking_price',
                'description' => 'Buscar preço de estacionamento'
            ],
            [
                'type' => 'api_create_company',
                'description' => 'Criar empresa'
            ],
            [
                'type' => 'api_update_company',
                'description' => 'Atualizar empresa'
            ],
            [
                'type' => 'api_show_company',
                'description' => 'Buscar empresa'
            ],
            [
                'type' => 'api_list_company',
                'description' => 'Listar empresas'
            ],
            [
                'type' => 'api_delete_company',
                'description' => 'Delete empresa'
            ],
            [
                'type' => 'api_create_vehicle',
                'description' => 'Criar veiculo'
            ],
            [
                'type' => 'api_update_vehicle',
                'description' => 'Atualizar veiculo'
            ],
            [
                'type' => 'api_show_vehicle',
                'description' => 'Buscar veiculo'
            ],
            [
                'type' => 'api_list_vehicle',
                'description' => 'Listar veiculos'
            ],
            [
                'type' => 'api_delete_vehicle',
                'description' => 'Deletar veiculos'
            ],
            [
                'type' => 'api_list_establishment_user',
                'description' => 'Listar estabelecimentos'
            ],
            [
                'type' => 'api_update_password_logged',
                'description' => 'Atualizar a senha com usuário logado',
            ],
        ];
    }
}
