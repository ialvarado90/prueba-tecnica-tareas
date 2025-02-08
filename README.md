## Prueba técnica

### Inforamción del proyecto
- PHP 8.1
- Laravel 10
- BD Mysql

### Cargar el proyecto
- Clonar o descargar proyecto
- Abrir consola y ubicarse en carpeta proyecto
- Ejecutar comando " composer install "
- Actualizar el archivo .env con la conexion a la base de datos
- Ejecutar comando " php artisan config:cache " y " php artisan route:cache "
- Crear base de datos " pt_tareas " e importar archivo .sql incluido en la raíz del proyecto
- Importar el collection en Postman, ubicado en la raíz del proyecto 
- En caso tabla "users" estuviera vacía, ejecutar comando " php artisan auth:user " para crear un usuario básico con rol "Administrador"

### Usuarios de Prueba

Administrador

User: ivan.admin@mail.com
Pass: abc123def

Usuario

User: ivan.usuario@mail.com
Pass: abc123def

### Tablas

Las siguientes tablas deben tener obligatoriamente los siguientes valores y id's

***roles***

<table>
    <thead>
        <tr>
            <th>id</th>
            <th>nombre</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Administrador</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Usuario</td>
        </tr>
    </tbody>
</table>

&nbsp;&nbsp;

## Api's 
En POSTMAN se tienen 2 variables de entorno {{SERVER}} y {{TOKEN}}:<br>
{{SERVER}} - Base url, ejem: "http://localhost:8080/api" <br>
{{TOKEN}} - Authorization Bearer Token

### ***Usuarios***
- POST login : enviar de formulario para iniciar sesión a aplicación (en POSTMAN actualizará automáticamente la variable de entorno {{TOKEN}})

##### Token required:
- GET create : Precarga de campos para formulario, combo para seleccionar Rol
- POST store : Envío de formulario y registro de Usuarios
- GET edit : Precarga de formulario con datos del registro y combo de Rol
- PUT update : Envío de formulario para actualizar datos de usuario
- POST logout : Cerrar sesión

&nbsp;

### ***Tareas***
##### Token required:
- POST store : Envío de formulario y registro de Tareas.
- GET edit : Precarga de formulario con datos del registro. <span style="color:red">*</span>
- PUT update : Envío de formulario para actualizar datos de la Tarea. <span style="color:red">*</span>
- PUT process : Cambiar de estado de atención de la Tarea "pending" | "completed". <span style="color:red">*</span>
- PUT destroy : Eliminar una tarea. <span style="color:red">*</span>
- POST list-filter-pagination : Listado de tareas con filtro por estado de atención y paginación.
- POST search : Búsqueda de tareas por título o descripción.

<span style="color:red">*</span> Solo Administradores y el Usuario que creo que su propia tarea
&nbsp;



