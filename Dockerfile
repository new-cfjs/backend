FROM php:apache
RUN apt-get update 
RUN apt-get install -y libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql pgsql
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN a2enmod proxy
RUN a2enmod proxy_http
RUN a2enmod headers
