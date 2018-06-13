# Cineja

Para desplegar la API, necesitaremos ejecutar los siguientes comandos:
<br/>
<br/>
El primer comando a ejecutar es un <b>"composer install"</b> 
para instalar todas la librerías necesarias para el correcto funcionamiento del proyecto
<br/>
<br/>
Una vez instaladas las librerías, pasaremos a ejecutar el siguiente comando para crear la base de datos y 
habiendo configurado anteriormente el archivo .env para la conexión a MYSQL:
<br/>
cd al directorio del proyecto y el comando <b>php bin/console doctrine:database:create</b>
<br/>
<br/>
Una vez creada la base de datos, pasaremos a crear las tablas a partir de las entidades con los siguientes comandos, 
(es recomendable quitar los archivos de la carpeta migrations que esta ubicada dentro de la capa de infrastructure antes de ejecutar los comando):
<br/>
<b>php bin/console doctrine:migrations:diff</b>
<br/>
<b>php bin/console doctrine:migrations:migrate</b>
<br/>
<br/>
Al terminar de crear las tablas de la base de datos, ya solo nos queda desplegar el sevidor con:
<br/>
<b>php bin/console server:run</b>
