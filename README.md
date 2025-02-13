# Proyecto A
## Descripción
Este proyecto es una aplicación Laravel para gestionar eventos y participantes.


### Endpoint para Conteo de Participantes!!

```bash
http://localhost:8000/api/events/participants-count

```

## Instalación y Configuración local

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-ejemplo/tu-ejemplo.git
cd  project-a

```

### 2. Instalar dependencias

```bash
composer install

```

### 3. Configurar el archivo de entorno

Copiar el archivo de ejemplo .env.example a .env

```bash
cp .env.example .env
```
Despues en el archivo .env configurar las siguientes variables

Base de datos:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_bd
DB_USERNAME=usuario
DB_PASSWORD=contraseña

Correo (Mailtrap):

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=usuario_mailtrap
MAIL_PASSWORD=contraseña_mailtrap
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=email@example.com
MAIL_FROM_NAME="Nombre del Proyecto"

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5. Crear la base de datos
Antes de ejecutar las migraciones, asegurarse de haber creado la base 
de datos en MySQL con el mismo nombre del archivo .env

### 6. Ejecutar migraciones

```bash
php artisan migrate
```

### 7. Levantar el servidor

```bash
php artisan serve
```


## Instalación y Configuración Docker

## 1 Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/project-a.git
cd project-a
```

## 2 Configurar el archivo .env

```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laraveluser
DB_PASSWORD=secret
```

## 3 Construir y levantar los contenedores

```bash
docker-compose up --build
```

## 4 Ejecutar las migraciones 

```bash
 docker-compose exec app php artisan migrate
```

## 5 Estara dispinible en:

```bash
http://localhost:8080
```

## 6 si el puerto 8080 esta en uso en el archivo docker-compose.yml se puede cambiar

```bash
ports:
  - "8081:80"
```
