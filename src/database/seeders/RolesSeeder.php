<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')
            ->insert(['nombre'=>'Profesional de proyectos - Desarrollador']);
        DB::table('roles')
            ->insert(['nombre'=>'Gerente estratégico']);
        DB::table('roles')
            ->insert(['nombre'=>'Auxiliar administrativo']);
    }
}
