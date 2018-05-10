<?php

use App\Container\Users\src\User;
use \Illuminate\Database\Seeder;
use App\Container\Permissions\src\Role;

class UsersGesapTableSeeder extends Seeder
{

    public function run()
    {
        User::insert([
            //Administrador
            ['name'=> 'Administrador',
             'lastname' => 'Admin',
             'state' => 'aprobado',
             'email' => 'administrador@App.com',
             'password' => bcrypt('123456')],
            //Coordinadores
            ['name'=> 'Coordinador',
             'lastname' => 'Coordinador',
             'state' => 'aprobado',
             'email' => 'Coordinador@App.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Gina',
             'lastname' => 'Valenzuela',
             'state' => 'aprobado',
             'email' => 'ginamaribelv@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Manuel ',
             'lastname' => 'Morales',
             'state' => 'aprobado',
             'email' => 'mamoralque@hotmail.com',
             'password' => bcrypt('123456')],
            //Evaluadores
            ['name'=> 'Evaluador',
             'lastname' => 'evaluador',
             'state' => 'aprobado',
             'email' => 'evaluador@App.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Cesar Yesid',
             'lastname' => 'Barahona Rodriguez',
             'state' => 'aprobado',
             'email' => 'cesarbana@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Francisco Alfono',
             'lastname' => 'Lanza Rodriguez',
             'state' => 'aprobado',
             'email' => 'lanzafranc@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Fernel',
             'lastname' => 'Moreno',
             'state' => 'aprobado',
             'email' => 'fernel.moreno@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Jaime Eduardo',
             'lastname' => 'Andrade Ramírez',
             'state' => 'aprobado',
             'email' => 'jaimeeduardoandrader@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Alexander ',
             'lastname' => 'Espinosa',
             'state' => 'aprobado',
             'email' => 'ilogic@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Oscar Javier ',
             'lastname' => 'Morera Zarate',
             'state' => 'aprobado',
             'email' => 'oscar.morera@gmail.com',
             'password' => bcrypt('123456')],
            //Estudiantes
            ['name'=> 'Daniel',
             'lastname' => 'Avendaño Puin',
             'state' => 'aprobado',
             'email' => 'dalaven1996@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Carlos',
             'lastname' => 'Reyes',
             'state' => 'aprobado',
             'email' => 'carlos_reyes_1992@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Ingri Gissela ',
             'lastname' => 'Correa Laverde',
             'state' => 'aprobado',
             'email' => 'yuyis942009@hotmail.comñ',
             'password' => bcrypt('123456')],
            ['name'=> 'Andres',
             'lastname' => 'Monroy',
             'state' => 'aprobado',
             'email' => 'andresd55@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Alejandro',
             'lastname' => 'Castrillon',
             'state' => 'aprobado',
             'email' => 'alejandrocastrillon.92@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Julian',
             'lastname' => 'Canon',
             'state' => 'aprobado',
             'email' => 'aliasjulius@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Dayana',
             'lastname' => 'Linares',
             'state' => 'aprobado',
             'email' => 'dayislinares_95@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'JOHN FREDY',
             'lastname' => 'ACOSTA LATORRE',
             'state' => 'aprobado',
             'email' => 'jhoacosta93@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'juanito ',
             'lastname' => 'perez ',
             'state' => 'aprobado',
             'email' => 'castrillonal@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Edwin',
             'lastname' => 'Clavijo',
             'state' => 'aprobado',
             'email' => 'edwinclavijo22@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Andres Felipe',
             'lastname' => 'Zambrano Romero',
             'state' => 'aprobado',
             'email' => 'mercenary94k@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Daniel Sebastian ',
             'lastname' => 'Arias Rojas',
             'state' => 'aprobado',
             'email' => 'd.s.a.r@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Brian',
             'lastname' => 'Bernal Hernandez',
             'state' => 'aprobado',
             'email' => 'brianbernal27@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Edisson Mauricio ',
             'lastname' => 'Ramirez Forero',
             'state' => 'aprobado',
             'email' => 'emauricioramirez@mail.unicundi.edu.co',
             'password' => bcrypt('123456')],
            ['name'=> 'Alejandra ',
             'lastname' => 'Poveda Galvis',
             'state' => 'aprobado',
             'email' => 'gapoveda@mail.unicundi.edu.co',
             'password' => bcrypt('123456')],
            ['name'=> 'Daniel Felipe',
             'lastname' => 'Valero Corzo',
             'state' => 'aprobado',
             'email' => 'felipe2421@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Yuli Tatiana',
             'lastname' => 'Chavez Ortiz',
             'state' => 'aprobado',
             'email' => 'tatis.mik50@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Jorge ALexis ',
             'lastname' => 'Poveda Galvis',
             'state' => 'aprobado',
             'email' => 'jalexispoveda010@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Paola Andrea ',
             'lastname' => 'Chia Rodriguez',
             'state' => 'aprobado',
             'email' => 'aloapaerdna_94@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Juan Pablo ',
             'lastname' => 'Millan Morales',
             'state' => 'aprobado',
             'email' => 'jpmillan777@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Josele',
             'lastname' => 'cortez',
             'state' => 'aprobado',
             'email' => 'joselitopuyolsito@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Johan Camilo',
             'lastname' => 'Suárez Campos',
             'state' => 'aprobado',
             'email' => 'hunterdark02@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Juan Camilo',
             'lastname' => 'Novoa Tellez',
             'state' => 'aprobado',
             'email' => 'juankmilo9508_@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Diego Alexander',
             'lastname' => 'Gomez Pinzon',
             'state' => 'aprobado',
             'email' => 'dagp940427@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Yeison Andrey ',
             'lastname' => 'Gomez Rubio',
             'state' => 'aprobado',
             'email' => 'yandrey.yg@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Jerson',
             'lastname' => 'Gutierrez',
             'state' => 'aprobado',
             'email' => 'jersongutierrez1@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Andres',
             'lastname' => 'Camacho',
             'state' => 'aprobado',
             'email' => 'cbandresf@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'john fredy',
             'lastname' => 'osorio franco',
             'state' => 'aprobado',
             'email' => 'jhfredy84@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Efrain Andres',
             'lastname' => 'Vergara Serrato',
             'state' => 'aprobado',
             'email' => 'efrainvergara.udec@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Fredy Fabian',
             'lastname' => 'Rodriguez Joya',
             'state' => 'aprobado',
             'email' => 'fredhyjoya@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Laura Camila',
             'lastname' => 'Sanchez Romero',
             'state' => 'aprobado',
             'email' => 'lauraacamila16@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Hector ',
             'lastname' => 'Castellanos',
             'state' => 'aprobado',
             'email' => 'hetcasro@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'jhon fredy',
             'lastname' => 'gallego henao',
             'state' => 'aprobado',
             'email' => 'fredyhenao45y@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Daniel Alejandro',
             'lastname' => 'Prado Mendoza',
             'state' => 'aprobado',
             'email' => 'dprado@mail.unicundi.edu.co',
             'password' => bcrypt('123456')],
            ['name'=> 'Ricardo Andrés ',
             'lastname' => 'Leyva Osorio ',
             'state' => 'aprobado',
             'email' => 'ricardoandres9728@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Stevenson',
             'lastname' => 'Marquez',
             'state' => 'aprobado',
             'email' => 'stevensonxmarquez@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Cristian Dario',
             'lastname' => 'Jojoa Cabrera',
             'state' => 'aprobado',
             'email' => 'cristianjojoa01@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Jorge Eduardo',
             'lastname' => 'Jaramillo Ramos ',
             'state' => 'aprobado',
             'email' => 'jjaramillorms@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Pedro Alexander',
             'lastname' => 'Chavez Gomez',
             'state' => 'aprobado',
             'email' => 'alexanderch95@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'jesus andres',
             'lastname' => 'castellanos aguilar',
             'state' => 'aprobado',
             'email' => 'jesusandrescastellanosudec@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Brayan Francisco ',
             'lastname' => 'Rodríguez Fajardo',
             'state' => 'aprobado',
             'email' => 'brayan-fr@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'jonathan david',
             'lastname' => 'velasquez velasquez',
             'state' => 'aprobado',
             'email' => 'davidalucarddh@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Diego Andrés',
             'lastname' => 'Carranza Rivera',
             'state' => 'aprobado',
             'email' => 'diacarry@gmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Andres Mauricio ',
             'lastname' => 'Riaño Gamboa',
             'state' => 'aprobado',
             'email' => 'mauricio.1707@hotmail.es',
             'password' => bcrypt('123456')],
            ['name'=> 'CRISTIAN ESNEIDER',
             'lastname' => 'RODRIGUEZ MORENO',
             'state' => 'aprobado',
             'email' => 'cristianrm0994@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Oscar Jobany',
             'lastname' => 'Gomez Ochoa',
             'state' => 'aprobado',
             'email' => 'caballero1094@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Miguel Angel',
             'lastname' => 'Ortiz Osorio',
             'state' => 'aprobado',
             'email' => 'miguelortiz1994@outlook.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Kevin Alexánder',
             'lastname' => 'Medina Arango',
             'state' => 'aprobado',
             'email' => 'kevinmedina_93@hotmail.com',
             'password' => bcrypt('123456')],
            ['name'=> 'Bryann',
             'lastname' => 'Amortegui',
             'state' => 'aprobado',
             'email' => 'brayanbip37@gmail.com',
             'password' => bcrypt('123456')]
        ]);


        $role1 = Role:: where('name' , 'Administrator_Gesap')->get(['id'])->first();
        $role2 = Role:: where('name' , 'Coordinator_Gesap')->get(['id'])->first();
        $role3 = Role:: where('name' , 'Evaluator_Gesap')->get(['id'])->first();
        $role4 = Role:: where('name' , 'Student_Gesap')->get(['id'])->first();

        $user = User::where('lastname', '=', 'Admin')->first();
        $user->roles()->sync($role1);



        $user = User::where('lastname', '=', 'Coordinador')->first();
        $user->roles()->sync($role2);

        $user = User::where('lastname', '=', 'Valenzuela')->first();
        $user->roles()->sync($role2);

        $user = User::where('lastname', '=', 'Morales')->first();
        $user->roles()->sync($role2);



        $user = User::where('lastname', '=', 'evaluador')->first();
        $user->roles()->sync($role3);

        $user = User::where('lastname', '=', 'Barahona Rodriguez')->first();
        $user->roles()->sync($role3);

        $user = User::where('lastname', '=', 'Lanza Rodriguez')->first();
        $user->roles()->sync($role3);

        $user = User::where('lastname', '=', 'Andrade Ramírez')->first();
        $user->roles()->sync($role3);

        $user = User::where('lastname', '=', 'moreno')->first();
        $user->roles()->sync($role3);

        $user = User::where('lastname', '=', 'Espinosa')->first();
        $user->roles()->sync($role3);

        $user = User::where('lastname', '=', 'Morera Zarate')->first();
        $user->roles()->sync($role3);



        $user = User::where('lastname', '=', 'Avendaño Puin')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Reyes')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Correa Laverde')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Monroy')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Castrillon')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Canon')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Linares')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'ACOSTA LATORRE')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'perez')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Clavijo')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Zambrano Romero')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Arias Rojas')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Bernal Hernandez')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Ramirez Forero')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Poveda Galvis')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Valero Corzo')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Chavez Ortiz')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Poveda Galvis')->where('name', '=', 'Jorge ALexis')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Chia Rodriguez')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Millan Morales')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Marquez')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'cortez')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Suárez Campos')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Novoa Tellez')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Gomez Pinzon')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Gomez Rubio')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Gutierrez')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Camacho')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'osorio franco')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Vergara Serrato')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Rodriguez Joya')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Sanchez Romero')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Castellanos')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'gallego henao')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Prado Mendoza')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Leyva Osorio')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Marquez')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Jojoa Cabrera')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Jaramillo Ramos')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Chavez Gomez')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'castellanos aguilar')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Rodríguez Fajardo')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'velasquez velasquez')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Carranza Rivera')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Riaño Gamboa')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'RODRIGUEZ MORENO')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Gomez Ochoa')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Ortiz Osorio')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Medina Arango')->first();
        $user->roles()->sync($role4);

        $user = User::where('lastname', '=', 'Amortegui')->first();
        $user->roles()->sync($role4);
    }
}
