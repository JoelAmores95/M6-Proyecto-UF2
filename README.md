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
 Municipios:    '/api/municipio' -> Lista de todos los municipios
                '/api/municipio/{nombreMunicipio}' -> Datos de un municipio

 Provincias:    '/api/provincia' -> Lista de provincias
                '/api/provincia/{nombreProvincia}' -> Todos los municipios de una provincia

 Comarcas:      '/api/comarca' -> Lista de comarcas
                '/api/comarca/{nombreComarca}' -> Todos los municipios de una comarca
