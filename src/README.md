<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



## Contenedor Docker
Para iniciar el contenedor con la configuración ejecute:
```
sudo docker-compose up --build
```
## Instalar componentes y crear llaves Laravel
###Ejecute en el contenedor docker:
```
sudo docker-compose exec app composer install

sudo docker-compose exec app php artisan key:generate
```

###En caso de no usar docker ejecute:
```
composer install

php artisan key:generate
```
Ahora puede poner en marcha el servidor ejecutando, solo si no está ejecutando docker u otro tipo de servidor:
```
php artisan serve
```

##Archivo .env Configuración de conexiones a bases de datos
el archivo .env en la sección de conexión puede contener los siguientes parámetros,
los cuales se usaron para crear la base de datos de prueba ó puede reemplazar con sus parámetros de conexión

```
DB_CONNECTION=mysql
DB_HOST=sql.freedb.tech
DB_PORT=3306
DB_DATABASE=freedb_nexura_test_db
DB_USERNAME=freedb_adminl
DB_PASSWORD=?kCn85xypSh5DTH
```
en caso de no encontrarse el archivo .env puede renombrar el archivo de ejemplo .env.example a .env y llenar lo parámetros

##Construcción de las bases de datos (Migraciones)
###Ejecute en el contenedor docker:
```
sudo docker-compose exec app php artisan migrate
```

###En caso de no usar docker ejecute:
```
php artisan migrate
```

## Llenar la base de datos

Para el coorecto funcionamiento del formulario se deben llenar las bases de datos
Areas y Roles.

###Ejecute en el contenedor docker:
```
 sudo docker-compose exec app php artisan db:seed --class=AreasSeeder

 sudo docker-compose exec app php artisan db:seed --class=RolesSeeder
 ```

###En caso de no usar docker ejecute:
```
 php artisan db:seed --class=AreasSeeder

 php artisan db:seed --class=RolesSeeder
 ```
