# Variables
COMPOSE_FILE = docker-compose.yml
APP_CONTAINER = app
DB_CONTAINER = laravel_mysql
NGINX_CONTAINER = laravel_nginx

# Colores para output
GREEN = \033[0;32m
YELLOW = \033[1;33m
RED = \033[0;31m
NC = \033[0m # No Color

# Comandos principales
.PHONY: help up down build restart logs shell composer artisan migrate seed fresh test

help: ## Mostrar esta ayuda
	@echo "$(GREEN)Comandos disponibles:$(NC)"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "$(YELLOW)%-20s$(NC) %s\n", $$1, $$2}'

up: ## Levantar todos los servicios
	@echo "$(GREEN)Levantando servicios...$(NC)"
	docker compose -f $(COMPOSE_FILE) up -d
	@echo "$(GREEN)Servicios levantados!$(NC)"
	@echo "$(YELLOW)Laravel: http://localhost:8000$(NC)"
	@echo "$(YELLOW)Nginx: http://localhost:80$(NC)"
	@echo "$(YELLOW)MySQL: localhost:3306$(NC)"

down: ## Detener todos los servicios
	@echo "$(RED)Deteniendo servicios...$(NC)"
	docker compose -f $(COMPOSE_FILE) down
	@echo "$(GREEN)Servicios detenidos!$(NC)"

build: ## Construir las imágenes de Docker
	@echo "$(YELLOW)Construyendo imágenes...$(NC)"
	docker compose -f $(COMPOSE_FILE) build --no-cache
	@echo "$(GREEN)Imágenes construidas!$(NC)"

restart: ## Reiniciar todos los servicios
	@echo "$(YELLOW)Reiniciando servicios...$(NC)"
	docker compose -f $(COMPOSE_FILE) restart
	@echo "$(GREEN)Servicios reiniciados!$(NC)"

logs: ## Mostrar logs de todos los servicios
	docker compose -f $(COMPOSE_FILE) logs -f

logs-app: ## Mostrar logs solo de la aplicación
	docker compose -f $(COMPOSE_FILE) logs -f $(APP_CONTAINER)

logs-db: ## Mostrar logs solo de la base de datos
	docker compose -f $(COMPOSE_FILE) logs -f $(DB_CONTAINER)

shell: ## Acceder al shell de la aplicación
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) bash

shell-db: ## Acceder al shell de MySQL
	docker compose -f $(COMPOSE_FILE) exec $(DB_CONTAINER) mysql -u laravel_user -p laravel_pos

composer: ## Ejecutar Composer (ej: make composer install)
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) composer $(filter-out $@,$(MAKECMDGOALS))

install: ## Instalar dependencias de Composer
	@echo "$(YELLOW)Instalando dependencias de Composer...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) composer install
	@echo "$(GREEN)Dependencias instaladas!$(NC)"

update: ## Actualizar dependencias de Composer
	@echo "$(YELLOW)Actualizando dependencias...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) composer update
	@echo "$(GREEN)Dependencias actualizadas!$(NC)"

artisan: ## Ejecutar comandos de Artisan (ej: make artisan migrate)
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan $(filter-out $@,$(MAKECMDGOALS))

migrate: ## Ejecutar migraciones
	@echo "$(YELLOW)Ejecutando migraciones...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan migrate
	@echo "$(GREEN)Migraciones ejecutadas!$(NC)"

migrate-fresh: ## Ejecutar migraciones desde cero
	@echo "$(YELLOW)Ejecutando migraciones frescas...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan migrate:fresh
	@echo "$(GREEN)Migraciones frescas ejecutadas!$(NC)"

seed: ## Ejecutar seeders
	@echo "$(YELLOW)Ejecutando seeders...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan db:seed
	@echo "$(GREEN)Seeders ejecutados!$(NC)"

fresh: ## Ejecutar migraciones frescas y seeders
	@echo "$(YELLOW)Ejecutando migraciones frescas y seeders...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan migrate:fresh --seed
	@echo "$(GREEN)Migraciones frescas y seeders ejecutados!$(NC)"

key: ## Generar clave de aplicación
	@echo "$(YELLOW)Generando clave de aplicación...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan key:generate
	@echo "$(GREEN)Clave generada!$(NC)"

storage-link: ## Crear enlace simbólico de storage
	@echo "$(YELLOW)Creando enlace simbólico de storage...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan storage:link
	@echo "$(GREEN)Enlace creado!$(NC)"

cache-clear: ## Limpiar cache
	@echo "$(YELLOW)Limpiando cache...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan cache:clear
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan config:clear
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan route:clear
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan view:clear
	@echo "$(GREEN)Cache limpiado!$(NC)"

test: ## Ejecutar tests
	@echo "$(YELLOW)Ejecutando tests...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) php artisan test
	@echo "$(GREEN)Tests ejecutados!$(NC)"

npm: ## Ejecutar NPM (ej: make npm install)
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) npm $(filter-out $@,$(MAKECMDGOALS))

npm-install: ## Instalar dependencias de NPM
	@echo "$(YELLOW)Instalando dependencias de NPM...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) npm install
	@echo "$(GREEN)Dependencias de NPM instaladas!$(NC)"

dev: ## Ejecutar Vite en modo desarrollo
	@echo "$(YELLOW)Ejecutando Vite en modo desarrollo...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) npm run dev

build-assets: ## Construir assets de producción
	@echo "$(YELLOW)Construyendo assets de producción...$(NC)"
	docker compose -f $(COMPOSE_FILE) exec $(APP_CONTAINER) npm run build
	@echo "$(GREEN)Assets construidos!$(NC)"

status: ## Mostrar estado de los contenedores
	@echo "$(YELLOW)Estado de los contenedores:$(NC)"
	docker compose -f $(COMPOSE_FILE) ps

clean: ## Limpiar contenedores, imágenes y volúmenes no utilizados
	@echo "$(RED)Limpiando Docker...$(NC)"
	docker system prune -f
	docker volume prune -f
	@echo "$(GREEN)Limpieza completada!$(NC)"

# Comando para capturar argumentos adicionales
%:
	@:
