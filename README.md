<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h2>¿COMO INSTALAR EL PROYECTO?</h2>

Antes que nada vamos a seguir los siguientes pasos para tener una excelente intalación, en primera instancia debemos tener descargado los siguientes programas para el entorno de desarrollo.

1.- VS Code o Culalquier entorno de desarrollo que más te acomodes.
2.- Xampp
3.- Git
4.- Composer (Instalar al final)

Una vez que tengas los programas instalados para el desarrollo de este proyecto, vamos abrir el proyecto en tu entorno de desarrollo, tendremos que verificar si tienemos el archivo .ENV para configurar nuestra base de datos en mysql (Está por defecto).

Configuramos lo necesario, una vez que ya tengamos todo en orden tendremos que verificar en la documentación de Laravel por favor, en este caso les pondre el comando a ejecutar para instalar composer, se recomienda mucho verificar la documentación.

composer global require laravel/installer

Una vez que hagamos ese paso, vamos a actualizar composer, este paso es importante, si lo ejecutamos sin este paso, nos dara error en una línea que es la siguiente:

Ejemplo: Fatal error: Uncaught Error: Failed opening required 'C:\xampp\htdocs\CoffeeMoon/vendor/autoload.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\CoffeeMoon\artisan:18

Una vez que haya terminado todo el proceso, ahora si podremos ejecutar el comando php artisan serve y los demás que haya disponibles.