# Usa una imagen base de PHP con Apache
FROM php:8.3-apache

# Instala extensiones de PHP necesarias para la aplicación
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia el código fuente de tu aplicación al directorio raíz de Apache
COPY . /var/www/html/

# Establece los permisos adecuados para que Apache pueda acceder al código
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Expone el puerto 80 para recibir tráfico web
EXPOSE 80

# Establece el comando para iniciar Apache cuando el contenedor se inicie
CMD ["apache2-foreground"]