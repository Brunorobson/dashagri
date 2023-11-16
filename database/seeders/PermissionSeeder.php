<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['id' => 1, 'name' => 'Ler Usuários', 'guard_name' => 'read_users'],
            ['id' => 2, 'name' => 'Escrever Usuários', 'guard_name' => 'write_users'],

            ['id' => 3, 'name' => 'Ler Permissões', 'guard_name' => 'read_permissions'],
            ['id' => 4, 'name' => 'Escrever Permissões', 'guard_name' => 'write_permissions'],

            ['id' => 5, 'name' => 'Ler Role', 'guard_name' => 'read_roles'],
            ['id' => 6, 'name' => 'Escrever Role', 'guard_name' => 'write_roles'],

            ['id' => 7, 'name' => 'Ler Fazenda', 'guard_name' => 'read_farms'],
            ['id' => 8, 'name' => 'Escrever Fazenda', 'guard_name' => 'write_farms'],

            ['id' => 9, 'name' => 'Ler Detalhes', 'guard_name' => 'read_details'],
            ['id' => 10, 'name' => 'Escrever Detalhes', 'guard_name' => 'write_details'],
        ]);

        //permission_role
        //Administrador = 2
        DB::table('permission_role')->insert([
            ['permission_id' => 1, 'role_id' => 2],
            ['permission_id' => 1, 'role_id' => 2],
            ['permission_id' => 3, 'role_id' => 2], 
            ['permission_id' => 5, 'role_id' => 2],
            ['permission_id' => 7, 'role_id' => 2],
            ['permission_id' => 8, 'role_id' => 2],
            ['permission_id' => 9, 'role_id' => 2],
            ['permission_id' => 10, 'role_id' => 2],
        ]);

        //Analista = 3
        DB::table('permission_role')->insert([
            ['permission_id' => 7, 'role_id' => 3],
            ['permission_id' => 9, 'role_id' => 3],
            ['permission_id' => 10, 'role_id' => 3],
        ]);

        //Fazendeiro = 4
        DB::table('permission_role')->insert([//Ler Submissões
            ['permission_id' => 1, 'role_id' => 4],
            ['permission_id' => 2, 'role_id' => 4],
            ['permission_id' => 7, 'role_id' => 4],
            ['permission_id' => 9, 'role_id' => 4],
        ]);

        //Convidado = 5
        DB::table('permission_role')->insert([
            ['permission_id' => 7, 'role_id' => 5], 
            ['permission_id' => 9, 'role_id' => 5],
        ]);

    }
}
