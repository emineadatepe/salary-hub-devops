# 1. Aşama: Temel imajı belirle (PHP ve Apache bir arada olan resmi imaj)
FROM php:8.2-apache

# 2. Aşama: MySQL ile iletişim kurabilmek için gerekli PHP eklentilerini kur
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 3. Aşama: Senin bilgisayarındaki tüm dosyaları konteynerin içine kopyala
# Apache'nin varsayılan çalışma dizini /var/www/html'dir.
COPY . /var/www/html/

# 4. Aşama: Apache'nin dış dünya ile konuşacağı portu belirt
EXPOSE 80