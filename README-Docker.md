# 🐳 Docker para Laravel POS

Este proyecto está configurado para ejecutarse completamente en contenedores Docker, incluyendo el backend de Laravel y la base de datos MySQL.

## 📋 Prerrequisitos

- Docker Desktop instalado y ejecutándose
- Make (opcional, pero recomendado para comandos simplificados)

## 🚀 Inicio Rápido

### 1. Configurar variables de entorno

Copia el archivo de ejemplo y ajusta las configuraciones:

```bash
cp env.docker .env
```

### 2. Levantar servicios

```bash
# Con Make (recomendado)
make up

# O con Docker Compose directamente
docker-compose up -d
```

### 3. Instalar dependencias

```bash
# Instalar dependencias de Composer
make install

# Instalar dependencias de NPM
make npm-install
```

### 4. Configurar Laravel

```bash
# Generar clave de aplicación
make key

# Crear enlace simbólico de storage
make storage-link

# Ejecutar migraciones
make migrate

# Ejecutar seeders (opcional)
make seed
```

### 5. Acceder a la aplicación

- **Laravel (desarrollo)**: http://localhost:8000
- **Nginx (producción)**: http://localhost:80
- **Base de datos**: localhost:3306

## 🛠️ Comandos Útiles

### Con Make (recomendado)

```bash
# Ver todos los comandos disponibles
make help

# Gestión de servicios
make up          # Levantar servicios
make down        # Detener servicios
make restart     # Reiniciar servicios
make build       # Construir imágenes
make status      # Ver estado de contenedores

# Comandos de Laravel
make artisan migrate      # Ejecutar migraciones
make artisan migrate:fresh # Migraciones desde cero
make artisan db:seed      # Ejecutar seeders
make fresh               # Migraciones + seeders
make key                 # Generar clave de app
make cache-clear         # Limpiar cache

# Comandos de Composer
make install             # Instalar dependencias
make update              # Actualizar dependencias

# Comandos de NPM
make npm-install         # Instalar dependencias
make dev                 # Modo desarrollo
make build-assets        # Construir assets

# Logs y debugging
make logs                # Ver logs de todos los servicios
make logs-app            # Logs solo de la app
make logs-db             # Logs solo de la BD
make shell               # Acceder al shell de la app
make shell-db            # Acceder a MySQL
```

### Con Docker Compose directamente

```bash
# Levantar servicios
docker-compose up -d

# Ver logs
docker-compose logs -f

# Ejecutar comandos en la app
docker-compose exec laravel_app php artisan migrate
docker-compose exec laravel_app composer install

# Acceder al shell
docker-compose exec laravel_app bash
```

## 🗄️ Base de Datos

### Configuración por defecto

- **Host**: mysql (nombre del contenedor)
- **Puerto**: 3306
- **Base de datos**: laravel_pos
- **Usuario**: laravel_user
- **Contraseña**: laravel_password
- **Root password**: root_password

### Conectar desde fuera de Docker

```bash
mysql -h localhost -P 3306 -u laravel_user -p laravel_pos
```

## 🔧 Configuración

### Variables de entorno importantes

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_pos
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_password
```

### Puertos

- **8000**: Laravel (desarrollo)
- **80**: Nginx (producción)
- **3306**: MySQL

## 🧹 Mantenimiento

### Limpiar Docker

```bash
make clean
```

### Reconstruir imágenes

```bash
make build
```

### Ver estado de contenedores

```bash
make status
```

## 🚨 Solución de Problemas

### Contenedor no inicia

1. Verificar que Docker esté ejecutándose
2. Revisar logs: `make logs`
3. Verificar puertos disponibles
4. Reconstruir: `make build`

### Error de permisos

```bash
# En Windows/Linux, ajustar permisos de storage
docker-compose exec laravel_app chmod -R 775 storage bootstrap/cache
```

### Base de datos no conecta

1. Verificar que el contenedor MySQL esté ejecutándose
2. Revisar variables de entorno
3. Verificar logs: `make logs-db`

## 📁 Estructura de Archivos Docker

```
docker/
├── php/
│   ├── Dockerfile          # Imagen de PHP
│   └── local.ini          # Configuración de PHP
├── nginx/
│   ├── nginx.conf         # Configuración principal de Nginx
│   └── default.conf       # Configuración del sitio
└── mysql/
    └── init/              # Scripts de inicialización de BD

docker-compose.yml          # Configuración de servicios
Makefile                    # Comandos simplificados
.dockerignore              # Archivos a excluir del build
env.docker                 # Variables de entorno para Docker
```

## 🔄 Flujo de Desarrollo

1. **Inicio del día**: `make up`
2. **Desarrollo**: Los cambios se reflejan automáticamente
3. **Dependencias**: `make install` o `make npm-install`
4. **Base de datos**: `make migrate` o `make fresh`
5. **Fin del día**: `make down`

## 🚀 Producción

Para producción, considera:

1. Cambiar `APP_ENV=production` en `.env`
2. Usar `make build-assets` para compilar assets
3. Configurar variables de entorno de producción
4. Usar volúmenes persistentes para la base de datos
5. Configurar backups automáticos

## 📚 Recursos Adicionales

- [Documentación de Docker](https://docs.docker.com/)
- [Laravel Sail](https://laravel.com/docs/sail)
- [Docker Compose](https://docs.docker.com/compose/)
