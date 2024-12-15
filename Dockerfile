# Dockerfile per estendere php:8.3-apache con MySQLi
FROM php:8.3-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql

RUN a2enmod rewrite

# Aggiungi la configurazione per permettere l'uso di .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Riavvia Apache (necessario per applicare le modifiche)
CMD ["apache2-foreground"]