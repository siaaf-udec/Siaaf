<p align="center"><img src="https://avatars2.githubusercontent.com/u/28413102?v=3&u=ac797da816f89f0bcdbbac1347603b2fbf2fe21f&s=400" width="200px"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
<a href="https://app.codeship.com/projects/219407"><img src="https://app.codeship.com/projects/de1c2f80-1a2d-0135-2583-4eee406cd8c3/status?branch=master" alt="Status?branch=master"></a>
</p>

# Siaaf

Sistema de Información para el Apoyo Administrativo - UdeC Facatativá

### Instalación

El proyecto esta desarrollado en [Laravel 5.4](https://laravel.com/docs/5.4/)

```sh
"Los puntos con simbolo ($) son comandos desde consola
 ubicado en la ruta del proyecto (C:\xampp\htdocs\Siaaf)"
 
1- Clonar proyecto desde GitKraken

2- Inicializar GifFlow y hacer Pull con la rama develop
   (rama la cual se trabajara en el proyecto)
   
3. $ composer install  

4- Copiar el archivo .env.example 
   (.env - copia.example) y cambiar el nombre a .env 
   
5- Dejar la configuracion DB de developer
   y del modulo asignado (Eliminar los demas modulos) ejemplo
   
   DB_HOST_DEVELOPER=127.0.0.1
   DB_DATABASE_DEVELOPER=developer
   DB_USERNAME_DEVELOPER=Miguel
   DB_PASSWORD_DEVELOPER=123456
   
   DB_HOST_SPORTCIT=127.0.0.1
   DB_DATABASE_SPORTCIT=sportcit
   DB_USERNAME_SPORTCIT=Miguel
   DB_PASSWORD_SPORTCIT=123456

5- Crear dos bases de datos con el respectivo nombre asignado en .env	
   y configurar el archivo .env ejemplo
   
   DB developer
   DB sportcit
   
6- $ php artisan key:generate
7- Migrar las bases de datos de developer y el modulo asignado ejemplo
   
    $ php artisan migrate --path=/database/migrations/developer --database=developer
    $ php artisan migrate --path=/database/migrations/sportcit --database=sportcit

8- php artisan db:seed
 
```

### Herramientas

* <a href="http://keenthemes.com/preview/metronic/theme/admin_2_material_design/index.html">Plantilla Base Metronic Material Theme</a>
* <a href="https://education.github.com/pack">GitHub Student Pack</a>
* <a href="https://www.gitkraken.com/">GitKraken</a>
* <a href="https://siaaf-cit.slack.com/">Canal de Comunicación de Notificaciones</a>
* <a href="http://codeship.com/">Codeship, pruebas de integración contínua</a>
* <a href="https://mailtrap.io/">Pruebas de Email

### Documentos
* <a href="http://es.presidencia.gov.co/dapre/DocumentosSIGEPRE/L-TI-12-denominacion-bases_de_datos.pdf">Denominacion Base de Datos</a>
* <a href="https://prezi.com/e9map5v-izuu/diagrama-de-caso-de-uso-y-diagrama-de-actividades/">Diagramas</a>
* <a href="https://msdn.microsoft.com/es-es/library/bb972214.aspx">Guia UML</a>
* <a href="http://www-2.dc.uba.ar/materias/isoft1/Apuntes/DiagramasDeActividad.pdf">Diagramas de Actividad</a>
* <a href="http://www.cyta.com.ar/ta0604/v6n4a1.htm">Procesos del Negocio a los Casos de Uso</a>