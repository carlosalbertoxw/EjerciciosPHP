# Imagen de PHP con la extensión GD instalada, necesaria para los ejercicios
# de 06_libreria_GD/ (crear y transformar imágenes).
#
# Partimos de la misma imagen de PHP que usa el servicio de consola y le
# añadimos GD, que no viene incluida por defecto.
FROM php:8.4.23-zts-alpine3.23

RUN apk add --no-cache libjpeg-turbo-dev libpng-dev freetype-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install gd
