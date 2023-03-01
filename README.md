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
