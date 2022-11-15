# BAUBYTE Framework

## Estructura de Directorios
    
### Código Fuente del Framework
 - [APP-SRC](./app-src)
    - [Documentación](./app-src/docs/)
    - [Acceso Publico](./app-src/public/)
    - [Núcleo Framework](./app-src/src/)
    - [Test Unitarios](./app-src/tests/)
 - [Imagen Docker](./docker/Dockerfile)
 - [Ayudantes para Ejecución desde la Terminal Bash](./helpers-bash/)
    - [Conexión Base de Datos MySql](./helpers-bash/app-db). 
        ```
            cd helpers-bash
            ./app-db
        ```
    - [Conexión Servidor Web desde la Terminal Bash](./helpers-bash/app-web). 
        ```
            cd helpers-bash
            ./app-web
        ```
        ```
            ./app-web
        ```
    - [Ejecutar Instrucciones de Composer al Servidor Web](./helpers-bash/composer). 
        ```
            cd helpers-bash
        ```
        ```
            ./composer run test
        ```
        ```
            ./composer php-cs-fixer
        ```
        ```
            ./composer require package
        ```
    - [Generar Documentación Con phpDocumentor](./helpers-bash/phpdoc). 
        ```
            cd helpers-bash
        ```
        ```
            ./phpdoc -d ./src -t ./docs
        ```
## Instrucciones
#### Requisitos tener docker y docker-compose
#### 1. Clonar repo
#### 2. Dentro del directorio del repo clonado abrir un Terminal y ejecutar:
    docker-compose up -d
#### 3. Una vez que se levanten los contenedores ejecutar usaremos unos helpers que se encuentran en el directorio [helpers-bash](./helpers-bash), para eso en le terminal no movemos al directorio:
    cd helpers-bash
#### 4. Vamos instalar todas las dependencias para eso usamos el helper [composer](./helpers-bash/composer) el cual pude recibir todos los argumentos de composer. Usamos el Terminal y ejecutamos:
    ./composer install
#### [Acceso Web](http://localhost:80).
#### [phpMyAdmin](http://localhost:81).
#### Usuario:
        root
#### Contraseña: 
        admin.root
#### Si querés parar la ejecución del contenedor ejecutar desde el terminal (recodar estar en la raiz del repositorio):
    docker-compose down
