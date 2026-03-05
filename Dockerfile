FROM php:8.2-apache

# PostgreSQL sürücüleri için gerekli sistem kütüphanelerini yükle
RUN apt-get update && apt-get install -y libpq-dev

# PHP'nin PostgreSQL eklentilerini (sürücülerini) yükle
RUN docker-php-ext-install pdo pdo_pgsql

# Proje dosyalarını kopyala
COPY . /var/www/html/

# Apache portunu aç
EXPOSE 80