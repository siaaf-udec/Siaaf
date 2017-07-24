# Seeders

Se creó una carpeta con una clase predefinida para el seeder por 
cada módulo con el fin de evitar conflictos en GitHub referente
a combinaciones de archivos o Merge. Dentro de estas subcarpetas
cada módulo puede crear su clase de Migración como lo requiera;
para su correcto funcionamiento se debe ejecutar:

```sh
$ composer dump-autoload
```
Seguido de ello se puede ejecutar el comando correspondiente
a cada módulo para realizar sus migraciones. Por ejemplo:

```sh
Módulo Financiero
$ php artisan db:seed --class=DatabaseFinancialSeeder
Espacios Académicos
$ php artisan db:seed --class=DatabaseAcadSpaceSeeder
Audiovisuales
$ php artisan db:seed --class=DatabaseAudiovisualesSeeder
Calisoft
$ php artisan db:seed --class=DatabaseCalisoftSeeder
Developer
$ php artisan db:seed --class=DatabaseDeveloperSeeder
Gesap
$ php artisan db:seed --class=DatabaseGesapSeeder
Interacción Universitaria
$ php artisan db:seed --class=DatabaseInteraccionSeeder
Módulo Parqueaderos
$ php artisan db:seed --class=DatabaseParkingSeeder
SporCit
$ php artisan db:seed --class=DatabaseSportCitSeeder
Talento Humano
$ php artisan db:seed --class=DatabaseTalentoHumanoSeeder
```