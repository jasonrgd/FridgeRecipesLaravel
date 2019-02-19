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
    supervisor

# Create webroot directories
RUN mkdir -p /var/www/html
WORKDIR /var/www/html

EXPOSE 9000
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
