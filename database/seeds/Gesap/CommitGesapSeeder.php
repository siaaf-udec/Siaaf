<?php

use App\Container\Gesap\src\Commits;
use \Illuminate\Database\Seeder;

class CommitGesapSeeder extends Seeder
{

    public function run()
    {
        Commits::insert([
            ['FK_NPRY_IdMctr008'=>'3',
            'FK_MCT_IdMctr008'=>'3',
            'FK_User_Codigo'=>'123456189',
            'FK_CHK_Checklist'=>'2',
            'CMMT_Commit'=>'En la Universidad de Cundinamarca'],

            ['FK_NPRY_IdMctr008'=>'3',
            'FK_MCT_IdMctr008'=>'4',
            'FK_User_Codigo'=>'123456189',
            'FK_CHK_Checklist'=>'2',
            'CMMT_Commit'=>'Como apoyo a la actividad.'],

            ['FK_NPRY_IdMctr008'=>'3',
            'FK_MCT_IdMctr008'=>'5',
            'FK_User_Codigo'=>'123456189',
            'FK_CHK_Checklist'=>'2',
            'CMMT_Commit'=>'En la Universidad de Cundinamarca'],

            ['FK_NPRY_IdMctr008'=>'3',
            'FK_MCT_IdMctr008'=>'6',
            'FK_User_Codigo'=>'123456189',
            'FK_CHK_Checklist'=>'2',
            'CMMT_Commit'=>'Actualmente en la Universidad de Cundinamarca '],

            ['FK_NPRY_IdMctr008'=>'3',
            'FK_MCT_IdMctr008'=>'7',
            'FK_User_Codigo'=>'123456189',
            'FK_CHK_Checklist'=>'2',
            'CMMT_Commit'=>'Diseñar, modificar y desarrollar la p'],

            ['FK_NPRY_IdMctr008'=>'3',
            'FK_MCT_IdMctr008'=>'8',
            'FK_User_Codigo'=>'123456189',
            'FK_CHK_Checklist'=>'2',
            'CMMT_Commit'=>'asddddddddddddddddasd.'],

            ['FK_NPRY_IdMctr008'=>'3',
            'FK_MCT_IdMctr008'=>'9',
            'FK_User_Codigo'=>'123456189',
            'FK_CHK_Checklist'=>'2',
            'CMMT_Commit'=>'Para el des'],

            ['FK_NPRY_IdMctr008'=>'3',
            'FK_MCT_IdMctr008'=>'20',
            'FK_User_Codigo'=>'123456189',
            'FK_CHK_Checklist'=>'2',
            'CMMT_Commit'=>'Los trabajos de fin de estudios de una'],

            ['FK_NPRY_IdMctr008'=>'3',
            'FK_MCT_IdMctr008'=>'11',
            'FK_User_Codigo'=>'123456189',
            'FK_CHK_Checklist'=>'2',
            'CMMT_Commit'=>'Baptista-lucio, C., & Cómo, P. (2014). Cómo se originan las investigaciones cuantitativas , cualitativas o mixtas, 24–29. Retrieved from http://metabase.uaem.mx/bitstream/handle/123456789/2771/506_2.pdf?sequence=1
            Bautista, J. (2012).'],
            
        ]);
    }
}