<?php

use App\Container\Users\Src\User;
use App\Container\Unvinteraction\src\TipoPregunta;
use App\Container\Unvinteraction\src\Sede;
use App\Container\Unvinteraction\src\Estado;
use Illuminate\Database\Seeder;


class UsersInteraccionSeeder extends Seeder
{

    public function run()
    {
         User::insert([
            //Administrador
            ['name'=> 'Administrador',
             'lastname' => 'Interaccion',
             'identity_no' => 1,
             'state' => 'aprobado',
             'email' => 'adminintera@app.com',
             'password' => bcrypt('123456')],
            //Coordinador
            ['name'=> 'Coordinador',
             'lastname' => 'Interaccion',
             'identity_no' => 2,
             'state' => 'aprobado',
             'email' => 'Coorintera@app.com',
             'password' => bcrypt('123456')],
            //Funcionario
            ['name'=> 'Funcionario',
             'lastname' => 'Interaccion',
             'identity_no' =>3,
             'state' => 'aprobado',
             'email' => 'funintera@app.com',
             'password' => bcrypt('123456')],
            //Pasante
            ['name'=> 'Pasante',
             'lastname' => 'Interaccion',
             'identity_no' => 4,
             'state' => 'aprobado',
             'email' => 'pasante@app.com',
             'password' => bcrypt('123456')],
            //Empresa
            ['name'=> 'Empresa',
             'lastname' => 'Interaccion',
             'identity_no' => 5,
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
