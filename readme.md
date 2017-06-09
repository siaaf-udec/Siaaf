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

### Requerimientos Locales

* PHP >= 5.6.4
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* MySQL >= 5.7.*

### Instalación

El proyecto esta desarrollado en [Laravel 5.4](https://laravel.com/docs/5.4/)

Despues de clonar el proyecto crear una copia del archivo .env.example y ejecutar.

```sh
$ composer install
$ Copiar el archivo .env.example 
  (.env - copia.example) y cambiar el nombre a .env 
$ Crear una base de datos y configurar el archivo .env ejemplo
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=siaaf
  DB_USERNAME=root
  DB_PASSWORD=
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
```

### Herramientas

* <a href="http://keenthemes.com/preview/metronic/theme/admin_2_material_design/index.html">Plantilla Base Metronic Material Theme</a>
* <a href="https://education.github.com/pack">GitHub Student Pack</a>
* <a href="https://www.gitkraken.com/">GitKraken</a>
* <a href="https://siaaf-cit.slack.com/">Canal de Comunicación de Notificaciones</a>
* <a href="http://codeship.com/">Codeship, pruebas de integración contínua</a>
* <a href="https://mailtrap.io/">Pruebas de Email
