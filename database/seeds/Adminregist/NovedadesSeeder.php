<?php

use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\AdminRegist\Src\Novedad;

class NovedadesSeeder extends Seeder
{

    public function run()
    {
        //Agregar novedades por defecto
        $novedad = new Novedad;
        $novedad->nombre_novedad = 'Matricula';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->nombre_novedad = 'Estudiantes Matriculados';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->nombre_novedad = 'Aplicación Transferencias Internas';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->nombre_novedad = 'Modificación Situación Estudiante';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->nombre_novedad = 'Aplicación Cancelación de Materia';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->nombre_novedad = 'Aplicación Traslado';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->nombre_novedad = 'Aplicación Homologaciones';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->nombre_novedad = 'Validaciones y Habilitaciones';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->nombre_novedad = 'Modificación de Notas';
        $novedad->save();


    }
}