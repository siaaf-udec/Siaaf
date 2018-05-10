<?php

use \Illuminate\Database\Seeder;

/*
 * Modelos
 */
use App\Container\Users\Src\User;

class UsersAudiovisualsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = [
            ['name'=>'Administrador','lastname'=>'Audiovisuales','birthday'=>'2017-08-20','identity_type'=>'C.C','identity_no'=>'1070977299','identity_expe_place'=>'Facatativa','identity_expe_date'=>'2017-08-23','address'=>'Calle 14 con Avenida 15','sexo'=>'Masculino','phone'=>'892 0707','email'=>'administrador@app.com','password' => bcrypt('administrador'),'state'=>'Aprobado','cities_id'=>'1','countries_id'=>'1','regions_id'=>'1'],
            ['name'=>'Funcionario','lastname'=>'Audiovisuales','birthday'=>'2017-08-20','identity_type'=>'C.C','identity_no'=>'1070975726','identity_expe_place'=>'Facatativa','identity_expe_date'=>'2017-08-23','address'=>'Calle 14 con Avenida 15','sexo'=>'Masculino','phone'=>'892 0707','email'=>'funcionario@app.com','password' => bcrypt('funcionario'),'state'=>'Aprobado','cities_id'=>'1','countries_id'=>'1','regions_id'=>'1'],
            ['name'=>'Cristian','lastname'=>'Audiovisuales','birthday'=>'2017-08-20','identity_type'=>'C.C','identity_no'=>'1070977299','identity_expe_place'=>'Facatativa','identity_expe_date'=>'2017-08-23','address'=>'Calle 14 con Avenida 15','sexo'=>'Masculino','phone'=>'892 0707','email'=>'funcionario2@app.com','password' => bcrypt('administrador'),'state'=>'Aprobado','cities_id'=>'1','countries_id'=>'1','regions_id'=>'1'],
            ['name'=>'Jerson','lastname'=>'Audiovisuales','birthday'=>'2017-08-20','identity_type'=>'C.C','identity_no'=>'1070977299','identity_expe_place'=>'Facatativa','identity_expe_date'=>'2017-08-23','address'=>'Calle 14 con Avenida 15','sexo'=>'Masculino','phone'=>'892 0707','email'=>'funcionario3@app.com','password' => bcrypt('administrador'),'state'=>'Aprobado','cities_id'=>'1','countries_id'=>'1','regions_id'=>'1'],

            ];

        foreach ($usuarios as $usuario ) {
            $aux = new User;
            $aux->name = $usuario['name'];
            $aux->lastname = $usuario['lastname'];
            $aux->birthday = $usuario['birthday'];
            $aux->identity_type = $usuario['identity_type'];
            $aux->identity_no = $usuario['identity_no'];
            $aux->identity_expe_place = $usuario['identity_expe_place'];
            $aux->identity_expe_date = $usuario['identity_expe_date'];
            $aux->address = $usuario['address'];
            $aux->sexo = $usuario['sexo'];
            $aux->phone = $usuario['phone'];
            $aux->email = $usuario['email'];
            $aux->password = $usuario['password'];
            $aux->state= $usuario['state'];
            $aux->cities_id= $usuario['cities_id'];
            $aux->countries_id= $usuario['countries_id'];
            $aux->regions_id= $usuario['regions_id'];
            $aux->save();
        }
        $useradministrador = User::find(2);
        $useradministrador->roles()->sync(2);
        $userfuncionario = User::find(3);
        $userfuncionario->roles()->sync(3);
    }
}
