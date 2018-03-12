<p align="center"><img src="https://styde.net/wp-content/uploads/2017/02/Screen-Shot-2017-02-13-at-19.40.02-e1487014892709.png" width="600px"></p>

Guia practica

### Introducción

**Laravel 5.4** viene con un nuevo componente llamado **Laravel Mix**, el cual es el sucesor de Laravel Elixir. Sin embargo, Laravel Mix está basado en **Webpack** en vez de Gulp. Webpack es una herramienta muy poderosa y versátil que nos permite compilar módulos dinámicos y sus dependencias en archivos estáticos y mucho más. Pero Webpack tiene una curva de aprendizaje mucho más empinada que Gulp y aquí es donde entra Laravel Mix: el cuál nos permite usar los features más relevantes de Webpack de una forma sencilla, rápida y casi transparente para nosotros los desarrolladores. En esta lección aprenderemos cómo instalar y utilizar Laravel Mix en pocos minutos:

#### Notas

Laravel Mix es el sucesor de Laravel Elixir  pero en vez de usar Gulp usa Webpack para realizar todas las tareas necesarias.

En la carpeta **/public** es donde se encuentran los archivos disponibles para el usuario así como los archivos CSS y Javascript compilados y comprimidos que usará la aplicación. 

Puedes entonces modificar estos archivos CSS y Javascript desde el directorio **/resources/assets**. Laravel trabaja por defecto con el preprocesador Sass y organiza los archivos en su respectiva carpeta y lo hace de manera modular.

Sin embargo, para que los cambios realizados en los archivos modificados puedan ser vistos por el usuario es que recurrimos al componente Laravel Mix. No sin antes tener preparado nuestro entorno de desarrollo instalando la última versión de Node.js.

Para comprobar que tienes instalado Node.js en tu entorno ejecuta **node -v** y su manejador de paquetes npm, ejecutando **npm -v**

Con npm podemos instalar las dependencias de Javascript para trabajar con Laravel mix, de la siguiente manera:

```sh
   $ npm install
```

Estas dependencias son las que se encuentran en el archivo package.json del proyecto. De igual forma, Laravel Mix tiene su propio archivo package.json que podemos analizar desde su repositorio en Github: package.json

Muchas de esas dependencias que se instalarán solo serán usadas en el entorno de desarrollo como por ejemplo:

. Con Laravel Mix podremos trabajar con la nueva sintaxis de Javascript por medio del componente Babel.

. Webpack para compilar y comprimir los archivos, entre otras tareas.
 
. Algunos componentes para desarrollar con Vue.js
  Recuerda que al instalar Node.js se crea una carpeta llamada **/node_modules** donde se encuentran todas las dependencias y al igual que el directorio **/vendor** de Composer esta carpeta es excluida por Git.


#### ¿Cómo trabajar con Laravel Mix?

En el archivo **package.json** de tu proyecto de Laravel te encontrarás con una serie de scripts que son comandos que puedes ejecutar con **npm**: **dev**, **watch**, **hot** y **production**.

Ejecutando **npm run dev** se compilará los archivos de Javascript y CSS presentes en el directorio **resources/assets** y como resultado se tendrán los nuevos archivos:

```sh
    /public/js/app.js
    /public/css/app.css
```

Usando el comando **dev** estos archivos resultantes no estarán comprimidos.

Puedes cambiar la configuración de donde estarán y cómo se llamarán estos archivos finales en el archivo webpack.mix.js.

Por otro lado, si ejecutas **npm run watch** funcionará de forma parecida a **dev** pero se quedará observando los cambios en los archivos **resources/assets** de forma de volver a compilar automáticamente si detecta cambios (sin ser necesario que ejecutes “npm run dev” otra vez).

Se usa **npm run production** para que adicional a compilar, también se compriman los archivos y de esta manera estén optimizados para el entorno de producción.

Con el método **version()** en el archivo webpack.mix.js podemos indicarle a Laravel Mix que cree versiones de los archivos de Javascript y CSS de nuestro proyecto y de esa forma los archivos resultantes tendrán un Hash para distinguir una versión de otra.  Pero debemos usar el helper de Laravel para que cargue los últimos archivos compilados sin necesidad de hacerlo manualmente cada vez que hagamos una modificacion:

```sh
   Para el CSS:
   href="{{ mix('css/app.css') }}"
   Para Javascript:
   src="{{ mix('js/app.js') }}"
```

Otro método con el que podemos trabajar es **extract** para dividir el único archivo js generado en 3:

.Código de la aplicación: app.js

.Bibliotecas vendor: vendor.js

.Manifest (Webpack Runtime): manifest.js

y así si modificamos únicamente parte del código de nuestra aplicación, entonces el navegador del usuario no tendría que descargar nuevamente las bibliotecas usadas como Vue, jQuery, entre otras. Para ello agrega esto: 

**.extract(['vue', jquery])** vuelve a compilar y para que se carguen correctamente coloca en tu layout:

```sh
    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
```
Si usas el método **version()** no olvides usar el helper mix para que cargue la última versión de cada archivo.

Con el comando npm run hot podemos recargar automáticamente solo módulos relacionados con Vue.js y no los demás componentes y manteniendo el estado de la aplicación.