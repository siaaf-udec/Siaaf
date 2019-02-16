<?php

use App\Container\Gesap\src\Mctr008;
use \Illuminate\Database\Seeder;

class ActividadesGesapSeeder extends Seeder
{

    public function run()
    {
        Mctr008::insert([


            ['MCT_Actividad'=>'Titulo Del Proyecto', 'MCT_Descripcion'=>'Nombre que describe brevemente el anteproyecto o proyecto que se desarrollara.', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Palabras Clave', 'MCT_Descripcion'=>'Palabras que sirven como instrumento para dar una idea de los términos mas usados o significativos en la investigación del proyecto.', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Impacto Del Proyecto', 'MCT_Descripcion'=>' Se refiere a la incidencia del proyecto dentro de espacios regionales, nacionales y/o globales en relación a los términos socioeconómicos, académicos, ambientales, de productividad.', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Trayectoria y capacidad en investigación', 'MCT_Descripcion'=>'desarrollo tecnológico e innovación del grupo: Es la trayectoria que ha tenido el grupo de investigación GITSFA desde el aval en Colciencias del 2010.', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Resumen Ejecutivo', 'MCT_Descripcion'=>'Es una idea precisa de la pertinencia y calidad del proyecto.', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Planteamiento del problema', 'MCT_Descripcion'=>'Descripción precisa y concreta de la idea del proyecto, debe contener la formulación de la pregunta a la cual se desea responder con la elaboración del proyecto.  Se debe tener claro cuál será el aporte con el desarrollo del proyecto.', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Objetivo General', 'MCT_Descripcion'=>'Los objetivos deben mostrar una relación clara y consistente con la descripción del problema y, específicamente, con las preguntas o hipótesis que se quieren resolver.', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Objetivos Especificos', 'MCT_Descripcion'=>'Los objetivos deben mostrar una relación clara y consistente con la descripción del problema y, específicamente, con las preguntas o hipótesis que se quieren resolver.', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Metodologia', 'MCT_Descripcion'=>' La metodología debe reflejar la estructura lógica y el rigor científico del proceso de investigación, empezando por la elección de un enfoque metodológico específico y finalizando con la forma como se van a analizar, interpretar y presentar los resultados. ', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Estado Del Arte', 'MCT_Descripcion'=>' Síntesis del contexto general (nacional y mundial) en el cual se ubica el tema de la propuesta, estado actual del conocimiento del problema, brechas que existen y vacío que se quiere llenar con el proyecto. Porqué y cómo la investigación propuesta, a diferencia de investigaciones previas, contribuirá, con probabilidades de éxito, a la solución o comprensión del problema planteado', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Bibliografia', 'MCT_Descripcion'=>'Se define como un catalogo o listado de los diferentes textos y autores que hacen parte del proceso de investigación y que fueron citados a lo largo del documento. ', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Cronograma', 'MCT_Descripcion'=>' Es donde se ubican las tareas que se deben realizar para lograr el desarrollo del proyecto asignándoles un tiempo de trabajo según los meses en los que se llevara a cabo el proyecto. ', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Detalles de personas', 'MCT_Descripcion'=>'Datos personales y públicos de los integrantes que participaran en el desarrollo del proyecto. ', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Financiacion', 'MCT_Descripcion'=>'Cuando un proyecto necesita recursos económicos se debe diligenciar dicha tabla con los datos de la financiación. ', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Resumen De Rubros', 'MCT_Descripcion'=>'Una tabla más específica del financiamiento del proyecto, dividiendo por categorías lo que se necesita para el desarrollo del m', 'FK_Id_Formato'=>'1'],
            ['MCT_Actividad'=>'Resultados', 'MCT_Descripcion'=>'Descripciones sobre los productos que se tendrán al final del desarrollo del proyecto, como por ejemplo el libro, los artículos elaborados, manuales, registro de derechos de autor, entre otros.', 'FK_Id_Formato'=>'1'],
            
            ['MCT_Actividad'=>'requerimiento 1', 'MCT_Descripcion'=>'Una tabla más específica del financiamiento del proyecto, dividiendo por categorías lo que se necesita para el desarrollo del m', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'requerimiento 2', 'MCT_Descripcion'=>'Una tabla más específica del financiamiento del proyecto, dividiendo por categorías lo que se necesita para el desarrollo del m', 'FK_Id_Formato'=>'2'],
            
            ['MCT_Actividad'=>'requerimiento 3', 'MCT_Descripcion'=>'Una tabla más específica del financiamiento del proyecto, dividiendo por categorías lo que se necesita para el desarrollo del m', 'FK_Id_Formato'=>'2'],
            
            ['MCT_Actividad'=>'requerimiento 4', 'MCT_Descripcion'=>'Una tabla más específica del financiamiento del proyecto, dividiendo por categorías lo que se necesita para el desarrollo del m', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'requerimiento 5', 'MCT_Descripcion'=>'Una tabla más específica del financiamiento del proyecto, dividiendo por categorías lo que se necesita para el desarrollo del m', 'FK_Id_Formato'=>'2'],
            

        ]);
    }
}
