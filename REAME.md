# Prueba técnica de Blog

Se genera un blog con una vista para listar posts y para ver sus detalles. 
Además de una api para listar (GET) y agregar(POST).

## Requisitos

- PHP 8.1 (fijado en composer)
- psr-4 (fijado en composer)
- Symfony 5.4 (actual LTS)
- Se agregan test unitarios
- API REST JSON
- programar en ingles

# Opcionales
- Se activa como plugin del PHPStorm el PHP CS Fixer y se ejecuta al final para aplicar los cambios.
- He instalado con composer el phpstan, y se integró con phpstorm
- los css y js usados en la parte web se cargan usando el webpack
- se instala la última versión de swagger para una pequeña implementación

## Proceso de implementación

Al principio me planteé si usar un sqlite o la api json propuesta de “https://jsonplaceholder.typicode.com/” , y al final me decidí por esa api. Y al usar la api externa, me hizo plantearme la posibilidad de hacer el front entero en javascript, y de hecho hice una parte, pero no era lo que se pedía. Por lo que finalmente, terminé haciendo los dos controladores, que además, eso me daba pié a usar mejor los modelos y servicios que luego utilizaría en la api.
Para ello monté los dos servicios, el serializador, para el control de json y objetos. Como la información se mueve como json, pero trabajamos con una programación orientada a objetos, para facilitar el paso de una cosa a la otra en todo momento. Y el servicio HttpService, que en parte, sustituye a lo que serían los repositorios de una supuesta base de datos.

En todo momento del desarrollo, se fué verificando el phpstan. Aunque al integrarlo en el Phpstorm, por un lado me gustó que en todo momento diese indicaciones, cosa que me gustó bastante, pero, por otro lado noté que desde que puse el phpstan, tarda en guardar los cambios y a veces tarda bastante en reflejarse en la ejecución del código los cambios hechos.

Se ejecutó al final el php cs fixed para aplicar los cambios en el formato del código. Puse en uno de los últimos commits los cambios del php cs fixed.


# Instalación:
- composer install
- yarn install / npm install
- yarn build
- 
# Componentes instalados:
- composer install
- yarn install / npm install
- yarn build