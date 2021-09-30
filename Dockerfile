FROM php:7.4.3-apache
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql
RUN a2enmod rewrite

# RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf

# RUN { \
#     echo 'IncludeOptional conf.d/*.conf'; \
#     } >> /usr/local/apache2/conf/httpd.conf \
#     && mkdir /usr/local/apache2/conf.d

COPY www/ /var/www/html