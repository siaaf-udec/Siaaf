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
        $novedad->NOV_NombreNovedad = 'Matricula';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->NOV_NombreNovedad = 'Estudiantes Matriculados';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->NOV_NombreNovedad = 'Aplicación Transferencias Internas';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->NOV_NombreNovedad = 'Modificación Situación Estudiante';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->NOV_NombreNovedad = 'Aplicación Cancelación de Materia';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->NOV_NombreNovedad = 'Aplicación Traslado';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->NOV_NombreNovedad = 'Aplicación Homologaciones';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->NOV_NombreNovedad = 'Validaciones y Habilitaciones';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->NOV_NombreNovedad = 'Modificación de Notas';
        $novedad->save();

        $novedad = new Novedad;
        $novedad->NOV_NombreNovedad = 'Otros';
        $novedad->save();
    }
}