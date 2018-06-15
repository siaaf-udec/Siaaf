<?php

use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Users\Src\User;
use App\Container\Permissions\Src\Role;

class UsersAutoevaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::where('name' , 'SuperAdmin_Autoevaluation')->get(['id'])->first();
        $role2 = Role::where('name' , 'PrimarySource_Autoevaluation')->get(['id'])->first();
        $role3 = Role::where('name' , 'SecondarySource_Autoevaluation')->get(['id'])->first();

        $user1=User::insert([
            //Super administrador
            ['name'=> 'Claudia',
                'lastname' => 'Norato',
                'identity_no' => 1,
                'state' => 'aprobado',
                'email' => 'claudiaauto@app.com',
                'password' => bcrypt('123456')]
        ]);

        $user1=User::where('name', '=', 'Claudia')->where('lastname', '=', 'Norato')->first();
        $user1->roles()->sync($role1);

        $user2=User::insert([
            //Fuentes primarias
            ['name'=> 'Alejandro',
                'lastname' => '*',
                'identity_no' => 2,
                'state' => 'aprobado',
                'email' => 'alejandros@app.com',
                'password' => bcrypt('123456')]
        ]);
        $user2=User::where('name', '=', 'Alejandro')->where('lastname', '=', '*')->first();
        $user2->roles()->sync($role2);

        $user3=User::insert([
            //Fuentes secundarias
            ['name'=> 'Liz',
                'lastname' => 'Quintero',
                'identity_no' =>3,
                'state' => 'aprobado',
                'email' => 'lizq@app.com',
                'password' => bcrypt('123456')]
        ]);
        $user3=User::where('name', '=', 'Liz')->where('lastname', '=', 'Quintero')->first();
        $user3->roles()->sync($role3);

    }
}
