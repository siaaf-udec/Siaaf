<?php

use App\Container\Users\Src\User;
use \Illuminate\Database\Seeder;

class UsersGesapTableSeeder extends Seeder
{

    public function run()
    {
        User::insert([
['name'=> 'Administrador','lastname' => 'Reyes','state' => 'aprobado','email' => 'administrador@gmail.com','password' => bcrypt( '123456')],
['name'=> 'Carlos','lastname' => 'Reyes','state' => 'aprobado','email' => 'carlos_reyes_1992@hotmail.com','password' => bcrypt( '123456')],
['name'=> 'Ingri Gissela ','lastname' => 'Correa Laverde','state' => 'aprobado','email' => 'yuyis942009@hotmail.comñ','password' => bcrypt( '123456')],
['name'=> 'Andres','lastname' => 'Monroy','state' => 'aprobado','email' => 'andresd55@hotmail.com','password' => bcrypt( '123456')],
['name'=> 'Alejandro','lastname' => 'Castrillon','state' => 'aprobado','email' => 'alejandrocastrillon.92@gmail.com','password' => bcrypt( '11b1204g')],
['name'=> 'Gina','lastname' => 'Valenzuela','state' => 'aprobado','email' => 'ginamaribelv@gmail.com','password' => bcrypt( 'zir145069')],
['name'=> 'Cesar Yesid','lastname' => 'Barahona Rodriguez','state' => 'aprobado','email' => 'cesarbana@gmail.com','password' => bcrypt( '7654321')],
['name'=> 'Francisco Alfono','lastname' => 'Lanza Rodriguez','state' => 'aprobado','email' => 'lanzafranc@gmail.com','password' => bcrypt( '1234567')],
['name'=> 'Julian','lastname' => 'Canon','state' => 'aprobado','email' => 'aliasjulius@gmail.com','password' => bcrypt( '123456')],
['name'=> 'Dayana','lastname' => 'Linares','state' => 'aprobado','email' => 'dayislinares_95@hotmail.com','password' => bcrypt( '123456')],
['name'=> 'Fernel','lastname' => 'Moreno','state' => 'aprobado','email' => 'fernel.moreno@gmail.com','password' => bcrypt( '1234567')],
['name'=> 'JOHN FREDY','lastname' => 'ACOSTA LATORRE','state' => 'aprobado','email' => 'jhoacosta93@hotmail.com','password' => bcrypt( '123456')],
['name'=> 'juanito ','lastname' => 'perez ','state' => 'aprobado','email' => 'castrillonal@hotmail.com','password' => bcrypt( '123456')],
['name'=> 'Edwin','lastname' => 'Clavijo','state' => 'aprobado','email' => 'edwinclavijo22@gmail.com','password' => bcrypt( '123456')],
['name'=> 'Andres Felipe','lastname' => 'Zambrano Romero','state' => 'aprobado','email' => 'mercenary94k@hotmail.com','password' => bcrypt( 'yosoy941130')],
['name'=> 'Daniel Sebastian ','lastname' => 'Arias Rojas','state' => 'aprobado','email' => 'd.s.a.r@hotmail.com','password' => bcrypt( '123456')],
['name'=> 'Brian','lastname' => 'Bernal Hernandez','state' => 'aprobado','email' => 'brianbernal27@gmail.com','password' => bcrypt( '5caracteres')],
['name'=> 'Edisson Mauricio ','lastname' => 'Ramirez Forero','state' => 'aprobado','email' => 'emauricioramirez@mail.unicundi.edu.co','password' => bcrypt( '5440202009')],
['name'=> 'Alejandra ','lastname' => 'Poveda Galvis','state' => 'aprobado','email' => 'gapoveda@mail.unicundi.edu.co','password' => bcrypt( '5440202009')],
['name'=> 'Daniel Felipe','lastname' => 'Valero Corzo','state' => 'aprobado','email' => 'felipe2421@hotmail.com','password' => bcrypt( '123456')],
['name'=> 'Yuli Tatiana','lastname' => 'Chavez Ortiz','state' => 'aprobado','email' => 'tatis.mik50@gmail.com','password' => bcrypt( '123456')],
['name'=> 'Jorge ALexis ','lastname' => 'Poveda Galvis','state' => 'aprobado','email' => 'jalexispoveda010@gmail.com','password' => bcrypt( '5440202009')],
['name'=> 'Paola Andrea ','lastname' => 'Chia Rodriguez','state' => 'aprobado','email' => 'aloapaerdna_94@hotmail.com','password' => bcrypt( '123456789')],
['name'=> 'Jaime Eduardo','lastname' => 'Andrade Ramírez','state' => 'aprobado','email' => 'jaimeeduardoandrader@gmail.com','password' => bcrypt( '1234567')],
['name'=> 'Alexander ','lastname' => 'Espinosa','state' => 'aprobado','email' => 'ilogic@gmail.com','password' => bcrypt( '1234567')],
['name'=> 'Oscar Javier ','lastname' => 'Morera Zarate','state' => 'aprobado','email' => 'oscar.morera@gmail.com','password' => bcrypt( '1234567')],
['name'=> 'Manuel ','lastname' => 'Morales','state' => 'aprobado','email' => 'mamoralque@hotmail.com','password' => bcrypt( 'Personal2016&')],
['name'=> 'Juan Pablo ','lastname' => 'Millan Morales','state' => 'aprobado','email' => 'jpmillan777@hotmail.com','password' => bcrypt( 'juan2016')],
['name'=> 'Docente','lastname' => 'Docente','state' => 'aprobado','email' => 'docente@gmail.com','password' => bcrypt( '7654321')],
['name'=> 'Evaluador','lastname' => 'evaluador','state' => 'aprobado','email' => 'evaluador@gmail.com','password' => bcrypt( '7654321')],
['name'=> 'Stevenson','lastname' => 'Marquez','state' => 'aprobado','email' => 'stevensonmarquez@live.com','password' => bcrypt( 'nomelase')],
['name'=> 'Josele','lastname' => 'cortez','state' => 'aprobado','email' => 'joselitopuyolsito@hotmail.com','password' => bcrypt( 'puyolsito:3')],
['name'=> 'Johan Camilo','lastname' => 'SuÃ¡rez Campos','state' => 'aprobado','email' => 'hunterdark02@hotmail.com','password' => bcrypt( '123456789')],
['name'=> 'Daniel','lastname' => 'AvendaÃ±o','state' => 'aprobado','email' => 'dalaven1996@gmail.com','password' => bcrypt( '1234')],
['name'=> 'Juan Camilo','lastname' => 'Novoa Tellez','state' => 'aprobado','email' => 'juankmilo9508_@hotmail.com','password' => bcrypt( 'juank123hack')],
['name'=> 'Diego Alexander','lastname' => 'Gomez Pinzon','state' => 'aprobado','email' => 'dagp940427@gmail.com','password' => bcrypt( '123danelly')],
['name'=> 'Yeison Andrey ','lastname' => 'Gomez Rubio','state' => 'aprobado','email' => 'yandrey.yg@gmail.com','password' => bcrypt( '92041578264')],
['name'=> 'Jerson','lastname' => 'Gutierrez','state' => 'aprobado','email' => 'jersongutierrez1@gmail.com','password' => bcrypt( 'mgjpes13')],
['name'=> 'Andres','lastname' => 'Camacho','state' => 'aprobado','email' => 'cbandresf@hotmail.com','password' => bcrypt( '941215')],
['name'=> 'john fredy','lastname' => 'osorio franco','state' => 'aprobado','email' => 'jhfredy84@hotmail.com','password' => bcrypt( 'Sandias12345')],
['name'=> 'Efrain Andres','lastname' => 'Vergara Serrato','state' => 'aprobado','email' => 'efrainvergara.udec@gmail.com','password' => bcrypt( '3115574699')],
['name'=> 'Fredy Fabian','lastname' => 'Rodriguez Joya','state' => 'aprobado','email' => 'fredhyjoya@gmail.com','password' => bcrypt( '95062106744')],
['name'=> 'Laura Camila','lastname' => 'Sanchez Romero','state' => 'aprobado','email' => 'lauraacamila16@hotmail.com','password' => bcrypt( 'lauracamila16*')],
['name'=> 'Hector ','lastname' => 'Castellanos','state' => 'aprobado','email' => 'hetcasro@gmail.com','password' => bcrypt( 'crystalpick12')],
['name'=> 'jhon fredy','lastname' => 'gallego henao','state' => 'aprobado','email' => 'fredyhenao45y@gmail.com','password' => bcrypt( 'deportfusa')],
['name'=> 'Daniel Alejandro','lastname' => 'Prado Mendoza','state' => 'aprobado','email' => 'dprado@mail.unicundi.edu.co','password' => bcrypt( 'Dany1204**')],
['name'=> 'Ricardo AndrÃ©s ','lastname' => 'Leyva Osorio ','state' => 'aprobado','email' => 'ricardoandres9728@hotmail.com','password' => bcrypt( 'Michi2006.')],
['name'=> 'Stevenson','lastname' => 'Marquez','state' => 'aprobado','email' => 'stevensonxmarquez@gmail.com','password' => bcrypt( 'sandia96')],
['name'=> 'Cristian Dario','lastname' => 'Jojoa Cabrera','state' => 'aprobado','email' => 'cristianjojoa01@gmail.com','password' => bcrypt( '19960101@@')],
['name'=> 'Jorge Eduardo','lastname' => 'Jaramillo Ramos ','state' => 'aprobado','email' => 'jjaramillorms@gmail.com','password' => bcrypt( '1071987967')],
['name'=> 'Pedro Alexander','lastname' => 'Chavez Gomez','state' => 'aprobado','email' => 'alexanderch95@gmail.com','password' => bcrypt( '3133243110')],
['name'=> 'jesus andres','lastname' => 'castellanos aguilar','state' => 'aprobado','email' => 'jesusandrescastellanosudec@gmail.com','password' => bcrypt( 'jesuselrey1')],
['name'=> 'Brayan Francisco ','lastname' => 'RodrÃ­guez Fajardo','state' => 'aprobado','email' => 'brayan-fr@hotmail.com','password' => bcrypt( 'YesicaBrayan117')],
['name'=> 'jonathan david','lastname' => 'velasquez velasquez','state' => 'aprobado','email' => 'davidalucarddh@gmail.com','password' => bcrypt( 'Davidor741')],
['name'=> 'Diego AndrÃ©s','lastname' => 'Carranza Rivera','state' => 'aprobado','email' => 'diacarry@gmail.com','password' => bcrypt( 'minudec2017')],
['name'=> 'Andres Mauricio ','lastname' => 'RiaÃ±o Gamboa','state' => 'aprobado','email' => 'mauricio.1707@hotmail.es','password' => bcrypt( 'mincho')],
['name'=> 'CRISTIAN ESNEIDER','lastname' => 'RODRIGUEZ MORENO','state' => 'aprobado','email' => 'cristianrm0994@hotmail.com','password' => bcrypt( '3125440386')],
['name'=> 'Oscar Jobany','lastname' => 'Gomez Ochoa','state' => 'aprobado','email' => 'caballero1094@hotmail.com','password' => bcrypt( 'OscarGomez10')],
['name'=> 'Miguel Angel','lastname' => 'Ortiz Osorio','state' => 'aprobado','email' => 'miguelortiz1994@outlook.com','password' => bcrypt( '84595126Miguel')],
['name'=> 'Kevin AlexÃ¡nder','lastname' => 'Medina Arango','state' => 'aprobado','email' => 'kevinmedina_93@hotmail.com','password' => bcrypt( 'Kevin9312')],
['name'=> 'Bryann','lastname' => 'Amortegui','state' => 'aprobado','email' => 'brayanbip37@gmail.com','password' => bcrypt( '95060907brayan901')]

        ]);


    }
}