# 1. Usamos PHP 8.3 con Apache (Más moderno, buena elección)
FROM php:8.3-apache

# 2. Instalar dependencias del sistema (He unificado tus bloques para que sea más rápido)
RUN apt-get update && apt-get install -y \
    curl \
    gnupg \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    # Limpieza de caché
    && apt-get -y clean \
    && rm -rf /var/lib/apt/lists/*

# 3. Extensiones de PHP necesarias para Laravel
RUN docker-php-ext-install pdo pdo_mysql zip exif pcntl gd bcmath opcache

# 4. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Configuración de Apache (SIN archivo externo)
# Usamos 'sed' para cambiar el DocumentRoot a /public directamente
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Habilitar mod_rewrite (Vital para Laravel)
RUN a2enmod rewrite

# 6. Directorio de trabajo
WORKDIR /var/www/html

# NOTA: No instalamos Node.js aquí porque ya tienes el servicio 'node' en docker-compose.