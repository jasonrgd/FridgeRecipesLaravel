FROM alpine:3.6
LABEL Maintainer="Dave Fuller <jason.rgd@gmail.com>" \
      Description="Lightweight container with Nginx 1.12 & PHP-FPM 7.1 based on Alpine Linux."

# Install packages
RUN apk --no-cache add \
    curl \
    nginx \
    php7 \
    php7-ctype \
    php7-curl \
    php7-dom \
    php7-fpm \
    php7-gd \
    php7-json \
    php7-intl \
    php7-mbstring \
    php7-mysqli \
    php7-openssl \
    php7-phar \
    php7-xml \
    php7-xmlreader \
    php7-zlib \
    php7-session \
    php7-tokenizer \
    php7-fileinfo \
    php7-xmlwriter \
    php7-posix \
    php7-soap \
    supervisor

#Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

# Create webroot directories
RUN mkdir -p /var/www/html
WORKDIR /var/www/html
COPY . /var/www/html/
RUN sh -c "composer install"

RUN chmod -R 777 storage
RUN chmod -R 777 bootstrap/cache

EXPOSE 9000
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
