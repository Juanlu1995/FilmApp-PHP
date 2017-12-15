# FilmApp

FilmApp es una aplicación web desarrollada en PHP en la cual los usuarios de la aplicación pueden añadir y valorrar películas.

---

## Instalación 


- La aplicación está escrita sobre `PHP 7.1`, por lo cual necesitarás del mismo para ejecutarla.
- La aplicación hace uso de paquetes externos los cuales necesitamos composer para instalarlos y ejecutamos el sigiente comando: `composer install`.


#### Creación de base de datos
- En la aplicación se incluye un script SQL de la creación de tablas de la base de datos llamado `FilmApp.sql`. Por lo mismo, sólo tendríamos que importar dicho script para crear la base de datos y sus tablas. La importación podríamos hacerla por comando con ```$ mysql -u username -p password < FilmApp.sql```, donde `username` es el nombre del usuario y `password` la contraseña del mismo.
- Si la aplicación está preparada para ser ejecutada tanto en heroku como en cualquier otro servicio, incluido local. Para ello necesitamos crear un archivo `.env` con una estructura como la del incluido `.env.example` , en la cual definimos el nombre de la base de datos, la dirección del servidor de la base de datos, usuario y contraseña de la misma.