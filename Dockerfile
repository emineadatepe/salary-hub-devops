FROM php:8.2-apache

# Sistem paketlerini güncelle ve PostgreSQL geliştirici kütüphanelerini yükle
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Proje dosyalarını kopyala
COPY . /var/www/html/

EXPOSE 80