¡¡¡PASOS PARA QUE LA BASE DE DATOS FUNCIONE!!!

0. Asegurarse que en localhost no haya ninguna base de datos «municipios».
1. php artisan migrate
2. php artisan db:seed
3. php artisan serve
4. Navegar hacia la url http://127.0.0.1:8000/guardarEnBaseDatos   (esta acción puede llevar algo de tiempo en completarse).
5. Al completarse, saldrá el mensaje «Los municipios del JSON se han guardado correctamente en la base de datos.».
6. Navegar hacia la url http://127.0.0.1:8000




Comarcas y Provincias:
https://www.idescat.cat/indicadors/?id=aec&n=15902&tema=terri&lang=es

Comarcas y Municipios:
https://www.idescat.cat/indicadors/?id=aec&n=15903&tema=terri&lang=es

## Elementos unidos en API/APICat.json ##

 - Ejecutar comanda 'php artisan migrate' para crear una base de datos 'municipios'.

 - Lanzar App con 'php artisan serve' 

 ## Para cargar por primera vez el JSON en la Base de Datos ##
 - Navegar a /guardarEnBaseDatos , al finalizar mostrará un mensaje de confirmación.

 ## Mostrar vista de todos los municipios
 - Navegar a la ruta '/'.

 ## APIs ##
 - Municipios:<br>    
                '/api/municipio' -> Lista de todos los municipios <br>
                '/api/municipio/{nombreMunicipio}' -> Datos de un municipio<br>

 - Provincias:<br>    
                '/api/provincia' -> Lista de provincias<br>
                '/api/provincia/{nombreProvincia}' -> Todos los municipios de una provincia<br>

 - Comarcas:<br>    
                '/api/comarca' -> Lista de comarcas<br>
                '/api/comarca/{nombreComarca}' -> Todos los municipios de una comarca<br>
