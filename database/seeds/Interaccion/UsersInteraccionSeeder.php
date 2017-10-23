<?php

use Illuminate\Database\Seeder;

class UsersInteraccionSeeder extends Seeder
{

    public function run()
    {
         User::insert([
            //Administrador
            ['name'=> 'Administrador',
             'lastname' => 'Interaccion',
             'state' => 'aprobado',
             'email' => 'adminintera@app.com',
             'password' => bcrypt('123456')],
            //Coordinador
            ['name'=> 'Coordinador',
             'lastname' => 'Interaccion',
             'state' => 'aprobado',
             'email' => 'Coorintera@app.com',
             'password' => bcrypt('123456')],
            //Funcionario
            ['name'=> 'Funcionario',
             'lastname' => 'Interaccion',
             'state' => 'aprobado',
             'email' => 'funintera@app.com',
             'password' => bcrypt('123456')],
            //Pasante
            ['name'=> 'Pasante',
             'lastname' => 'Interaccion',
             'state' => 'aprobado',
             'email' => 'pasante@app.com',
             'password' => bcrypt('123456')],
            //Empresa
            ['name'=> 'Empresa',
             'lastname' => 'Interaccion',
             'state' => 'aprobado',
             'email' => 'empresa@app.com',
             'password' => bcrypt('123456')]
            ]);

         	$user = User::where('name', '=', 'Administrador')->first();
            $user->roles()->sync(2);
            $user = User::where('name', '=', 'Coordinador')->first();
            $user->roles()->sync(3);
            $user = User::where('name', '=', 'Funcionario')->first();
            $user->roles()->sync(4);
            $user = User::where('name', '=', 'Pasante')->first();
            $user->roles()->sync(5);
            $user = User::where('name', '=', 'Empresa')->first();
            $user->roles()->sync(6);
    }
}
