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
- Se activa como plugin del PHPStorm el PHP CS Fixer
- He instalado con composer el phpstan
- los css y js usados en la parte web se cargan usando el webpack
- se instala la última versión de swagger para una pequeña implementación

## Proceso de implementación

He decidido generar un pequeño sqlite para hacer una persistencia real, donde prepararé algunos datos iniciales en un pequeño fixture.

# Instalación:
- composer install
- yarn install / npm install
- yarn build