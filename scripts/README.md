## Instrucciones para el dump de la base de datos de la API

Instalar dependencias con : composer intall
Configurar variables de entorno de la base de datos en .env

Generar clave secreta para JWT con: php artisan jwt:secret

Ejecutar las migraciones por defecto que trae laravel con: php artisan migrate:refresh --seed
Esto útlimo creara unos usuarios disponibles para hacer login y obtener un token de acceso
También puede usarse el endpoint /api/auth/register para crear un usuario y obtener un token de acceso.

Se deben crear las tablas cargando el script tablas.sql a la base de datos
Luego se pueden insertar datos usando el script datos.sql a la base de datos

Finalizado esto la API esta disponible para ser consumida.