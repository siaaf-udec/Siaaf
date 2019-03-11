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
            //requerimientos//
            ['MCT_Actividad'=>'Introducción', 'MCT_Descripcion'=>'Breve descripción que de un inicio al documento de Especificación de Requisitos Software (ERS).', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Propósito', 'MCT_Descripcion'=>'Propósito del documento ERS y a quien va dirigido', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Ámbito del Sistema', 'MCT_Descripcion'=>'Se crea un posible nombre para el sistema, se explica lo que el sistema hará y lo que no hará, los objetivos y los beneficios del sistema.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Definiciones, Acrónimos y Abreviaturas ', 'MCT_Descripcion'=>'Se definirán todos los términos, acrónimos y abreviaturas utilizadas en la ERS.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Referencias', 'MCT_Descripcion'=>'Una lista completa con los documentos referenciados en la ERS.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Visión General del Documento', 'MCT_Descripcion'=>'Se describe brevemente los contenidos y la organización de la ERS.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Descripción General', 'MCT_Descripcion'=>' Se describen los factores que afectan al producto y a sus requisitos. Se describe el contexto de los requisitos.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Perspectiva del producto', 'MCT_Descripcion'=>'Se debe relacionar, si es el caso, el futuro sistema con otros productos, también se debe especificar si el sistema es totalmente independiente.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Funciones Del Producto', 'MCT_Descripcion'=>' Resumen a grandes rasgos de las funciones del futuro sistema.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Caracteristicas del Usuario', 'MCT_Descripcion'=>'Descripciones de las características de los usuarios del producto final del sistema.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Restricciones', 'MCT_Descripcion'=>'Descripción de aquellas limitaciones que se impongan ante los desarrolladores del producto. ', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Suposiciones y Dependencias', 'MCT_Descripcion'=>'Aquellos factores que si llegan a cambiar pueden afectar la funcionalidad del producto. ', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Requisitos Futuros', 'MCT_Descripcion'=>'Futuras posibles mejoras al sistema.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Requisitos Específicos', 'MCT_Descripcion'=>'Esta sección contiene los requisitos a un nivel de detalle suficiente como para permitir a los diseñadores diseñar un sistema que satisfaga estos requisitos,
            y que permita al equipo de pruebas planificar y realizar las pruebas que demuestren si el sistema satisface, o no, los requisitos. Todo requisito aquí especificado describirá comportamientos externos del sistema, perceptibles por parte de los usuarios, operadores y otros sistemas.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Interfaces Externas', 'MCT_Descripcion'=>'Requisitos que afecten la interfaz de usuario, interfaz con otros sistemas e interfaces de comunicaciones.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Funciones', 'MCT_Descripcion'=>'Especificaciones de todas aquellas acciones (funciones) que deberá llevar a cabo el sistema. ', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Requisitos de Rendimiento', 'MCT_Descripcion'=>'Requisitos relacionados con la carga que se espera tenga que soportar el sistema. ', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Requisitos de Diseño', 'MCT_Descripcion'=>'Todo aquello que restrinja las decisiones relativas al diseño de la aplicación: Restricciones de otros estándares, limitaciones del hardware, etc.', 'FK_Id_Formato'=>'2'],
            ['MCT_Actividad'=>'Requisitos del Sistema', 'MCT_Descripcion'=>'Descripción detallada de los atributos del sistema.', 'FK_Id_Formato'=>'2'],
            ///Libro
            ['MCT_Actividad'=>'Estado Del Arte', 'MCT_Descripcion'=>'Síntesis del contexto general (nacional y mundial) en el cual se ubica el tema de la propuesta, estado actual del conocimiento del problema, brechas que existen y vacío que se quiere llenar con el proyecto. Porqué y cómo la investigación propuesta, a diferencia de investigaciones previas, contribuirá, con probabilidades de éxito, a la solución o comprensión del problema planteado.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Planteamiento del Problema y Pregunta de Investigación', 'MCT_Descripcion'=>'Descripción precisa y concreta de la idea del proyecto, debe contener la formulación de la pregunta a la cual se desea responder con la elaboración del proyecto.  Se debe tener claro cuál será el aporte con el desarrollo del proyecto.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Objetivo General y Objetivos Específicos', 'MCT_Descripcion'=>'Los objetivos deben mostrar una relación clara y consistente con la descripción del problema y, específicamente, con las preguntas o hipótesis que se quieren resolver.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Alcance e impacto del Proyecto', 'MCT_Descripcion'=>'Se refiere a la incidencia del proyecto dentro de espacios regionales, nacionales y/o globales en relación a los términos socioeconómicos, académicos, ambientales, de productividad.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Metodologia', 'MCT_Descripcion'=>'La metodología debe reflejar la estructura lógica y el rigor científico del proceso de investigación, empezando por la elección de un enfoque metodológico específico y finalizando con la forma como se van a analizar, interpretar y presentar los resultados.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Marcos de Referencia', 'MCT_Descripcion'=>'El marco teórico se refiere a definición de conceptos, una investigación más pequeña de la necesidad del proyecto. Por otra parte, el marco legal es referenciar leyes, decretos, entre otros que sean aplicables al proyecto en desarrollo.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Plan de Proyecto', 'MCT_Descripcion'=>' Una imagen en PDF de lo realizado en una herramienta para planeación de proyectos, estimando tiempos y recursos.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Determinación de Requerimientos', 'MCT_Descripcion'=>' Es el archivo de Requerimientos IEEE realizado para la propuesta de anteproyecto.  ', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Especificaciones del Diseño (Modelados UML)', 'MCT_Descripcion'=>'Se compone del Modelo Entidad Relacion, Diagramas de casos de uso, diagramas de secuencia, diagramas de actividades y diagramas de clases que el estudiante debe realizar en una herramienta como Star UML o Architect.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Diseño de los Casos de Prueba (Calisoft)', 'MCT_Descripcion'=>'Resultados de las pruebas hechas en la plataforma Calisoft.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Estimacion de Recursos', 'MCT_Descripcion'=>'Tablas diligenciadas con los gastos estimados para el desarrollo del proyecto.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Resultados', 'MCT_Descripcion'=>' Breve descripción concluyendo si se dio respuesta a la pregunta planteada.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Conclusiones y Recomendaciones', 'MCT_Descripcion'=>'Descripción de lo logrado en el desarrollo del proyecto y algunas recomendaciones sobre el proceso que hubo para la realización del proyecto.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Bibliografía', 'MCT_Descripcion'=>'Se define como un catálogo o listado de los diferentes textos y autores que hacen parte del proceso de investigación y que fueron citados a lo largo del documento.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Anexos', 'MCT_Descripcion'=>'Un manual para usuarios, se debe especificar por rol. Un manual de instalación.', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Articulo de Propuesta:', 'MCT_Descripcion'=>'En base al Estado del Arte producir un articulo donde se proponga una idea de anteproyecto. ', 'FK_Id_Formato'=>'3'],
            ['MCT_Actividad'=>'Articulo de Resultados:', 'MCT_Descripcion'=>'En base al desarrollo del proyecto, producir un articulo donde se evidencie lo que se ha hecho y como ha sido el proceso de realización del proyecto.', 'FK_Id_Formato'=>'3'],

            


        ]);
    }
}
