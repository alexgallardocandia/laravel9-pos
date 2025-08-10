#!/bin/bash

# Colores para output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${GREEN}🐳 Configurando Docker para Laravel POS...${NC}\n"

# Verificar si Docker está ejecutándose
if ! docker info > /dev/null 2>&1; then
    echo -e "${RED}❌ Docker no está ejecutándose. Por favor, inicia Docker Desktop.${NC}"
    exit 1
fi

echo -e "${GREEN}✅ Docker está ejecutándose${NC}"

# Verificar si Make está disponible
if ! command -v make &> /dev/null; then
    echo -e "${YELLOW}⚠️  Make no está disponible. Instalando...${NC}"
    
    # Para Windows con Git Bash
    if [[ "$OSTYPE" == "msys" || "$OSTYPE" == "cygwin" ]]; then
        echo -e "${YELLOW}📥 Descargando Make para Windows...${NC}"
        curl -L -o make.exe https://github.com/jgm/pandoc/releases/download/2.19.2/pandoc-2.19.2-windows-x86_64.zip
        # Nota: En Windows, puedes usar comandos de Docker Compose directamente
        echo -e "${YELLOW}💡 En Windows, puedes usar 'docker-compose' en lugar de 'make'${NC}"
    else
        echo -e "${RED}❌ Por favor, instala Make en tu sistema${NC}"
        exit 1
    fi
else
    echo -e "${GREEN}✅ Make está disponible${NC}"
fi

# Crear archivo .env si no existe
if [ ! -f .env ]; then
    echo -e "${YELLOW}📝 Creando archivo .env...${NC}"
    cp env.docker .env
    echo -e "${GREEN}✅ Archivo .env creado${NC}"
else
    echo -e "${GREEN}✅ Archivo .env ya existe${NC}"
fi

# Construir imágenes de Docker
echo -e "${YELLOW}🔨 Construyendo imágenes de Docker...${NC}"
docker-compose build --no-cache

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Imágenes construidas correctamente${NC}"
else
    echo -e "${RED}❌ Error al construir imágenes${NC}"
    exit 1
fi

# Levantar servicios
echo -e "${YELLOW}🚀 Levantando servicios...${NC}"
docker-compose up -d

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Servicios levantados correctamente${NC}"
else
    echo -e "${RED}❌ Error al levantar servicios${NC}"
    exit 1
fi

# Esperar a que MySQL esté listo
echo -e "${YELLOW}⏳ Esperando a que MySQL esté listo...${NC}"
sleep 10

# Verificar estado de los contenedores
echo -e "${YELLOW}📊 Estado de los contenedores:${NC}"
docker-compose ps

echo -e "\n${GREEN}🎉 ¡Configuración completada!${NC}\n"

echo -e "${YELLOW}📋 Próximos pasos:${NC}"
echo -e "1. Instalar dependencias: ${GREEN}make install${NC}"
echo -e "2. Generar clave de aplicación: ${GREEN}make key${NC}"
echo -e "3. Ejecutar migraciones: ${GREEN}make migrate${NC}"
echo -e "4. Acceder a la aplicación: ${GREEN}http://localhost:8000${NC}\n"

echo -e "${YELLOW}📚 Comandos útiles:${NC}"
echo -e "- Ver todos los comandos: ${GREEN}make help${NC}"
echo -e "- Ver logs: ${GREEN}make logs${NC}"
echo -e "- Detener servicios: ${GREEN}make down${NC}\n"

echo -e "${GREEN}¡Tu aplicación Laravel está ejecutándose en Docker! 🚀${NC}"
