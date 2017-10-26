<?php

use Illuminate\Database\Seeder;

/*
 * Modelos
 */

use App\Container\Audiovisuals\Src\Articulo;

class ArticulosTableAudiovisualsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articulos = [

            ['FK_ART_Tipo_id' => '1','ART_Descripcion'=>'Portátil ASUS - X540YA - AMD A8 - 15" Pulgadas - Disco Duro 1Tb - Negro','FK_ART_Kit_id'=>'1','FK_ART_Estado_id'=>'4','ART_Codigo'=>'78948728374'],
            ['FK_ART_Tipo_id' => '1','ART_Descripcion' => 'Portátil ASUS - X441NA - Intel Dual-Core Celeron - 14" Pulgadas - Disco Duro 500Gb - Plata','FK_ART_Kit_id'=>'1','FK_ART_Estado_id'=>'4','ART_Codigo'=>'1234567890'],
            ['FK_ART_Tipo_id' => '1','ART_Descripcion' => 'Portátil ASUS - X405UA - Intel Core i5 - 14" Pulgadas - Disco Duro 1Tb - Gris','FK_ART_Kit_id'=>'4','FK_ART_Estado_id'=>'4','ART_Codigo'=>'8948374829'],
            ['FK_ART_Tipo_id' => '1','ART_Descripcion' => 'Portátil ASUS - X405UA - Intel Core i3 - 14" Pulgadas - Disco Duro 1Tb - Gris','FK_ART_Kit_id'=>'3','FK_ART_Estado_id'=>'4','ART_Codigo'=>'3849039049'],
            ['FK_ART_Tipo_id' => '1','ART_Descripcion' => 'Portátil LENOVO - Idea110 - Intel Celeron - 14" Pulgadas - Disco Duro 500Gb - Negro','FK_ART_Kit_id'=>'2','FK_ART_Estado_id'=>'4','ART_Codigo'=>'384094829'],
            ['FK_ART_Tipo_id' => '2','ART_Descripcion' => 'Control Remoto Lg Smart Tv','FK_ART_Kit_id'=>'2','FK_ART_Estado_id'=>'4','ART_Codigo'=>'1232323243'],
            ['FK_ART_Tipo_id' => '2','ART_Descripcion' => 'Control Remoto Lg Smart Tv','FK_ART_Kit_id'=>'3','FK_ART_Estado_id'=>'4','ART_Codigo'=>'2564564345'],
            ['FK_ART_Tipo_id' => '2','ART_Descripcion' => 'Control Remoto Lg Smart Tv','FK_ART_Kit_id'=>'1','FK_ART_Estado_id'=>'4','ART_Codigo'=>'3466434556'],
            ['FK_ART_Tipo_id' => '2','ART_Descripcion' => 'Control Remoto Lg Smart Tv','FK_ART_Kit_id'=>'4','FK_ART_Estado_id'=>'4','ART_Codigo'=>'3452434567'],
            ['FK_ART_Tipo_id' => '2','ART_Descripcion' => 'Control Remoto Lg Smart Tv','FK_ART_Kit_id'=>'1','FK_ART_Estado_id'=>'4','ART_Codigo'=>'3453256674'],
            ['FK_ART_Tipo_id' => '3','ART_Descripcion' => 'Cable Hdmi 10mts Premium Enmallado Doble Filtro','FK_ART_Kit_id'=>'2','FK_ART_Estado_id'=>'4','ART_Codigo'=>'3445344345'],
            ['FK_ART_Tipo_id' => '3','ART_Descripcion' => 'Cable Hdmi 5 Metros Doble Filtro','FK_ART_Kit_id'=>'3','FK_ART_Estado_id'=>'4','ART_Codigo'=>'7584345245'],
            ['FK_ART_Tipo_id' => '3','ART_Descripcion' => 'Cable Hdmi 3 Metros Doble Filtro','FK_ART_Kit_id'=>'4','FK_ART_Estado_id'=>'4','ART_Codigo'=>'2345345643'],
            ['FK_ART_Tipo_id' => '3','ART_Descripcion' => 'Cable Hdmi 15 Metros Premium Enmallado Doble Filtro','FK_ART_Kit_id'=>'1','FK_ART_Estado_id'=>'4','ART_Codigo'=>'5654567543'],
            ['FK_ART_Tipo_id' => '3','ART_Descripcion' => 'Cable Hdmi 30 Metros Malla','FK_ART_Kit_id'=>'1','FK_ART_Estado_id'=>'4','ART_Codigo'=>'2357889906'],
            ['FK_ART_Tipo_id' => '3','ART_Descripcion' => 'Cable De Poder Cable Para Lg Tv 42lg50 42lg70 42lk450','FK_ART_Kit_id'=>'2','FK_ART_Estado_id'=>'4','ART_Codigo'=>'3244467775'],
            ['FK_ART_Tipo_id' => '3','ART_Descripcion' => 'Cable De Poder Cable Para Lg Tv 42lg50 42lg70 42lk450','FK_ART_Kit_id'=>'1','FK_ART_Estado_id'=>'4','ART_Codigo'=>'7674344453'],
            ['FK_ART_Tipo_id' => '3','ART_Descripcion' => 'Cable De Poder Cable Para Lg Tv 42lg50 42lg70 42lk450','FK_ART_Kit_id'=>'4','FK_ART_Estado_id'=>'4','ART_Codigo'=>'3245677890'],
            ['FK_ART_Tipo_id' => '3','ART_Descripcion' => 'Cable De Poder Cable Para Lg Tv 42lg50 42lg70 42lk450','FK_ART_Kit_id'=>'3','FK_ART_Estado_id'=>'4','ART_Codigo'=>'3456777432'],
            ['FK_ART_Tipo_id' => '3','ART_Descripcion' => 'Cable De Poder Cable Para Lg Tv 42lg50 42lg70 42lk450','FK_ART_Kit_id'=>'1','FK_ART_Estado_id'=>'4','ART_Codigo'=>'7755634342'],
            ['FK_ART_Tipo_id' => '4','ART_Descripcion' => 'Video Proyector Epson Bright Link 421i+ Xga 2500 Lumens 200w','FK_ART_Kit_id'=>'3','FK_ART_Estado_id'=>'4','ART_Codigo'=>'7356342243'],
            ['FK_ART_Tipo_id' => '5','ART_Descripcion' => 'Cabina Activa Kohlt Usa Kmas15a Bt Usb Sd 800 Wts Rms Sonido','FK_ART_Kit_id'=>'1','FK_ART_Estado_id'=>'4','ART_Codigo'=>'7233232321'],

        ];

        foreach ($articulos as $articulo) {
            $aux = new Articulo;
            $aux->FK_ART_Tipo_id = $articulo['FK_ART_Tipo_id'];
            $aux->ART_Descripcion = $articulo['ART_Descripcion'];
            $aux->FK_ART_Kit_id = $articulo['FK_ART_Kit_id'];
            $aux->FK_ART_Estado_id = $articulo['FK_ART_Estado_id'];
            $aux->ART_Codigo = $articulo['ART_Codigo'];

            $aux->save();
        }
    }
}
