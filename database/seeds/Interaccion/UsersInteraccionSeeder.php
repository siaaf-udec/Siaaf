<?php

use App\Container\Users\src\User;
use App\Container\Permissions\src\Role;
use Illuminate\Database\Seeder;


class UsersInteraccionSeeder extends Seeder
{

    public function run()
    {
        $role1 = Role::where('name' , 'Admin_uni')->get(['id'])->first();
        $role2 = Role::where('name' , 'Coordinador_uni')->get(['id'])->first();
        $role3 = Role::where('name' , 'Funcionario_uni')->get(['id'])->first();
        $role4 = Role::where('name' , 'Pasante_uni')->get(['id'])->first();
        $role5 = Role::where('name' , 'Empresario_uni')->get(['id'])->first();
        
          $user1=User::insert([
            //Administrador
            ['name'=> 'Administrador',
             'lastname' => 'Interaccion',
             'identity_no' => 1,
             'state' => 'aprobado',
             'email' => 'adminintera@app.com',
             'password' => bcrypt('123456')]
              ]);
                
             $user1=User::where('name', '=', 'Administrador')->where('lastname', '=', 'Interaccion')->first();
             $user1->roles()->sync($role1);
            
            $user2=User::insert([
            //Coordinador
            ['name'=> 'Coordinador',
             'lastname' => 'Interaccion',
             'identity_no' => 2,
             'state' => 'aprobado',
             'email' => 'Coorintera@app.com',
             'password' => bcrypt('123456')]
            ]);
             $user2=User::where('name', '=', 'Coordinador')->where('lastname', '=', 'Interaccion')->first();
            $user2->roles()->sync($role2);
        
            $user3=User::insert([
            //Funcionario
            ['name'=> 'Funcionario',
             'lastname' => 'Interaccion',
             'identity_no' =>3,
             'state' => 'aprobado',
             'email' => 'funintera@app.com',
             'password' => bcrypt('123456')]
            ]);
             $user3=User::where('name', '=', 'Funcionario')->where('lastname', '=', 'Interaccion')->first();
            $user3->roles()->sync($role3);
            $user4=User::insert([
            //Pasante
            ['name'=> 'Pasante',
             'lastname' => 'Interaccion',
             'identity_no' => 4,
             'state' => 'aprobado',
             'email' => 'pasante@app.com',
             'password' => bcrypt('123456')]
            ]);
         $user4=User::where('name', '=', 'Pasante')->where('lastname', '=', 'Interaccion')->first();
            $user4->roles()->sync($role4);
        
            $use51=User::insert([
            //Empresa
            ['name'=> 'Empresa',
             'lastname' => 'Interaccion',
             'identity_no' => 5,
             'state' => 'aprobado',
             'email' => 'empresa@app.com',
             'password' => bcrypt('123456')]
            ]);
         $user5=User::where('name', '=', 'Empresa')->where('lastname', '=', 'Interaccion')->first();
            $user5->roles()->sync($role5);
    }
}
