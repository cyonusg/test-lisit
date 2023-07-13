# Imagen base de PHP con Composer
FROM php:8.1-fpm

# Directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar los archivos de la aplicación al contenedor
COPY . .

# Instalar dependencias de la aplicación con Composer
RUN composer install --no-interaction --no-scripts --no-plugins

# Generar la clave de la aplicación
RUN php artisan key:generate

# Configurar los permisos adecuados en las carpetas de almacenamiento
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage


EXPOSE 8000

# Comando para ejecutar la aplicación Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
