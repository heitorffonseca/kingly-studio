<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'Acessar Painel Administrador', 'reference' => 'admin'],

            ['name' => 'Listar usuários', 'reference' => 'list_users'],
            ['name' => 'Visualizar usuário', 'reference' => 'view_user'],
            ['name' => 'Criar usuário', 'reference' => 'store_user'],
            ['name' => 'Editar usuário', 'reference' => 'update_user'],
            ['name' => 'Excluir usuário', 'reference' => 'destroy_user'],

            ['name' => 'Listar perfis', 'reference' => 'list_profiles'],
            ['name' => 'Visualizar perfil', 'reference' => 'view_profile'],
            ['name' => 'Criar perfil', 'reference' => 'store_profile'],
            ['name' => 'Editar perfil', 'reference' => 'update_profile'],
            ['name' => 'Excluir perfil', 'reference' => 'destroy_profile'],

            ['name' => 'Listar Notas Fiscais', 'reference' => 'list_invoices'],
            ['name' => 'Visualizar Nota Fiscal', 'reference' => 'view_invoice'],
            ['name' => 'Validar Nota Fiscal', 'reference' => 'validate_invoice'],
            ['name' => 'Excluir Nota Fiscal', 'reference' => 'destroy_invoice'],
        ];

        foreach ($permissions as $permission)
            Permission::create($permission);
    }
}
