#!/bin/bash

# Configuración
DIR_PROYECTO="/home/iker/Reto"
DIR_BACKUP="/home/iker/backups"
FECHA=$(date +"%Y-%m-%d_%H-%M")

# Crear carpeta de backups
mkdir -p $DIR_BACKUP

echo "--- Iniciando Backup: $FECHA ---"

# 1. Copia de la Base de Datos
cd $DIR_PROYECTO
/usr/bin/docker compose exec -T db mysqldump -u root -proot reto_db > $DIR_BACKUP/db_$FECHA.sql

# 2. Copia de los Archivos Web
tar -czf $DIR_BACKUP/files_$FECHA.tar.gz --exclude=vendor -C $DIR_PROYECTO .

# 3. Limpieza (Borrar backups viejos de más de 7 días)
find $DIR_BACKUP -type f -mtime +7 -delete

echo "--- Backup Finalizado Correctamente ---"
