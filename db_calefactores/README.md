//entrega 1

# db_calefactores

## Integrantes
- Pedro Colella (pedrocolella@gmail.com)
- Luciano Fiaschetti (luchinio_n@gmail.com)

## Tematica 
Administracion de calefactores.

## Descripcion
El sistema brinda un catalogo de calefactores agrupandolos por modelos (1:n), facilitando el control de stock de mercaderia, y permite al usuario hacer consultas por modelos segun sus caracteristicas.

## DER 
![Diagrama DER](img/DER.jpg)


// entrega 2 

DESCRIPCIÓN BREVE:
Este proyecto es una aplicación web desarrollada en PHP que permite la 
visualización, filtrado y administración de un catálogo de calefactores 
y sus respectivos modelos.


El sistema cuenta con dos entornos principales:
1. Sección Pública: Permite a cualquier usuario navegar por el inicio, 
   explorar los distintos modelos de calefactores disponibles, filtrar 
   productos por modelo y acceder a la ficha técnica detallada de cada 
   calefactor.
2. Sección de Administración (Privada): Un panel protegido por sesión 
   segura donde los usuarios administradores pueden realizar operaciones 
   CRUD completas (Crear, Leer, Actualizar y Eliminar) tanto para los 
   modelos (incluyendo la subida y gestión de imágenes) como para los 
   calefactores.

========================================================================
CARACTERÍSTICAS TÉCNICAS:
========================================================================
* Arquitectura: Basada en el patrón MVC (Modelo-Vista-Controlador).
* Orientación a Objetos: Implementación completa mediante clases y 
  métodos en PHP.
* Base de Datos: Conexión segura mediante PDO con el uso de consultas 
  preparadas para la prevención de inyecciones SQL.
* Seguridad: Autenticación de usuarios con verificación de contraseñas 
  encriptadas (password_verify).
* Gestión de Archivos: Lógica integrada para la carga y almacenamiento 
  dinámico de imágenes de los modelos en el servidor.
