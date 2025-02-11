# Usa una imagen base de PHP con Apache
FROM php:8.3-apache
# Copia el código fuente de tu aplicación al directorio raíz de Apache
COPY . /var/www/html/calculadora