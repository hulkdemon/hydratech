## HYDRATECH
La aplicación web de cobro de agua potable ha sido diseñada para facilitar y agilizar el proceso de facturación y cobro del servicio de agua potable a los usuarios.

## Introducción
Para clonar o instalar un proyecto desde un repositorio de GitHub en el entorno local, se deben seguir unos pasos de instalación. A continuación, se mostrarán los pasos, desde cómo clonar el repositorio hasta el proceso de instalación en nuestra máquina, los comandos que se utilizarán, así como otros puntos que se deben realizar dentro de la carpeta y algunos archivos hasta realizar las migraciones de las bases de datos. Todos son importantes y no se debe saltar ninguno.

[TOCM]

## Requerimientos
Para instalar y correr la aplicación web en tu entorno local se debe tener instalados o instalar lo siguientes servicios.

![](https://th.bing.com/th?q=Para+Que+Sirve+Xampp&w=120&h=120&c=1&rs=1&qlt=90&cb=1&dpr=1.3&pid=InlineBlock&mkt=es-MX&cc=MX&setlang=es&adlt=moderate&t=1&mw=247)
- XAMPP es un paquete de software que incluye los componentes necesarios para crear un entorno de desarrollo web local. Proporciona un servidor web (Apache), un sistema de gestión de bases de datos (MySQL), y lenguajes de programación como PHP y Perl. 
[Link de descarga](http://www.apachefriends.org/download.html)

![](https://th.bing.com/th/id/OIP.mFob_nJmwmMPrR4V7M9sAQHaJz?w=136&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7)
- Composer es una herramienta de administración de dependencias para proyectos de desarrollo de software en PHP. Es una herramienta basada en línea de comandos que permite a los desarrolladores definir y administrar las bibliotecas y paquetes de terceros que su proyecto necesita para funcionar correctamente.
[Link de descarga](http://getcomposer.org)

![](https://th.bing.com/th?q=Icono+Git&w=120&h=120&c=1&rs=1&qlt=90&cb=1&dpr=1.3&pid=InlineBlock&mkt=es-MX&cc=MX&setlang=es&adlt=moderate&t=1&mw=247)
- Git es un sistema de control de versiones distribuido ampliamente utilizado en el desarrollo de software. Proporciona un registro de cambios detallado y un historial de versiones para archivos y proyectos completos. Tambien ofrece una terminal (cmd) donde se puede trabjar con ella (es opcional).
[Link de descarga](http://git-scm.com)

- Para trabajar en el proyecto se debe tener instalado un editor de codigo este es el que se prefiera más pero en Visual Studio Code dentro lleva una terminar donde se puede trabajar directamente en la carpeta del proyecto aqui te dejo el enlace de descascarga:
[Link de descarga](http://code.visualstudio.com/Download)

## Proceso de instalación en el entorno local
Para instalar la aplicación web en tu entorno local, sigue estos simples pasos.

- Obtén el enlace del repositorio: Dentro de la página del repositorio GitHub, copia el enlace del repositorio. Puedes encontrarlo en la parte superior derecha, en el botón verde "<>Code".

- Clonar el repositorio: En tu terminal preferido, navega hasta la ubicación de la carpeta que se creó al instalar Xampp hasta encontrar la carpeta llamada "htdocs". Dentro de esa carpeta debe ir la carpeta de la aplicación web. Una vez obtenida la dirección de la ubicación en la terminal, ejecuta el siguiente comando para clonar el repositorio. Reemplaza "enlace del repositorio" con el enlace que copiaste en el paso anterior. Esto descargará el repositorio en tu máquina local.
`$ git clone <enlace del repositorio>`

- Navega al directorio del proyecto: Al terminar el proceso de clonación del proyecto, ve al directorio del proyecto utilizando el siguiente comando. Reemplaza "nombre de la carpeta del repositorio" con el nombre de la carpeta que se creó después de clonar el repositorio.
`cd <nombre de la carpeta del repositorio>`

- Instala las dependencias: Si la aplicación web tiene dependencias, deberás instalarlas. Comúnmente, las dependencias están definidas en un archivo package.json. Ejecuta el siguiente comando para instalar las dependencias:
`npm install`

- Restaurar la carpeta vendor: De igual manera, al clonar el proyecto en nuestro equipo local, la carpeta vendor se ignora y se debe restaurar mediante el siguiente comando. Este comando crea la carpeta vendor para poder trabajar correctamente en la aplicación web.
`composer install`

- Inicia la aplicación: Una vez que se hayan instalado las dependencias y configurado la aplicación, ejecuta el comando para iniciar la aplicación. Esto variará dependiendo del tipo de aplicación, framework o tecnología utilizada. Algunos ejemplos comunes son:
`npm start npm run dev`

- Ejecutar el servidor php: Podemos abrir el proyecto de dos maneras. Una es poner la URL de la dirección en nuestro explorador de archivos como "localhost/.../", y la segunda es ejecutar el servidor de php que te da una dirección IP que se puede abrir en el navegador web. El comando es el siguiente:
`php artisan serve`

## Modificaciones en el archivo .env:
Se debe modificar un archivo dentro de la carpeta llamada ".env". Cuando se sube un proyecto al repositorio de GitHub, este archivo se ignora y no aparece en el repositorio. Esto es una medida de seguridad para proteger datos importantes en el proyecto y evitar que sean robados. Al clonar el repositorio en nuestra máquina, se crea el archivo ".env.example". Vamos a copiar ese archivo en la misma ubicación y le cambiaremos el nombre a ".env", eliminando solo el ".example". Esto es necesario para que nuestra aplicación web pueda funcionar correctamente en el navegador web de nuestro equipo, ya que ahí se encuentran las credenciales, como la conexión a la base de datos (usuario, contraseña, host, puerto y nombre de la base de datos).

- Crear una llave para la aplicación: Dentro del archivo ".env", hay un campo que solicita una llave. Esta llave es necesaria para que toda la aplicación pueda funcionar correctamente al momento de ejecutarla en el navegador. Para generar esta llave, utiliza el siguiente comando:
`php artisan key:generate`

- Conexión a la base de datos: Para establecer la conexión a la base de datos, existen campos dentro del archivo donde se deben colocar los datos correspondientes. Asegúrate de que estos campos sean correctos para tu base de datos.

- Modificar el campo APP_URL: Si estás trabajando con el servidor de PHP, debes poner la dirección URL que se generó en ese campo (es opcional).

## Realizar las migraciones
- Ejecutar las migraciones en la base de datos: Una vez que todo esté configurado correctamente, debes realizar las migraciones en tu base de datos con el siguiente comando:
`php artisan migrate`

### Fin