<?php
/**
 * Copyright (c) 2017. Todos los derechos reservados. Ley N° 23 de 1982 Colombia.
 */

/**
 * Created by PhpStorm.
 * User: Daniel Prado
 * Date: 21/07/2017
 * Time: 11:28 AM
 */

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Container\Acadspace\src\Roles;
use App\Container\Acadspace\src\PerimisosAcadSpace;

class DatabaseAcadSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleAcadspaceSeeder::class);
        $this->call(PermissionAcadspaceSeeder::class);
        $this->call(EspaciosTableSeeder::class);
		$this->call(SoftwareTableSeeder::class);

    }
}