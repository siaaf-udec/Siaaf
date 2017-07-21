<?php
/**
 * Copyright (c) 2017 - 2017. Todos los derechos reservados. Ley N° 23 de 1982 Colombia.
 */

/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 21/07/2017
 * Time: 11:31 AM
 */

use App\Container\Users\Src\User;
use \Illuminate\Database\Seeder;

class UsersFinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( User::class, 1 )->create([
            'name' => 'financial',
            'email' => 'financial@app.com',
            'password' => bcrypt('financial'),
        ]);
    }
}