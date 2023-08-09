FROM composer AS composer

ENV APP_URL=http://0.0.0.0:3030

ENV DB_CONNECTION=mysql \
    MYSQL_HOST=localhost \
    MYSQL_PORT=3306 \
    MYSQL_DBNAME=devcode \
    MYSQL_USER=root \
    MYSQL_PASSWORD=password

# copying the source directory and install the dependencies with composer
COPY /src /app

# run composer install to install the dependencies
RUN composer install \
  --optimize-autoloader \
  --no-interaction \
  --no-progress
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN cp .env.example .env
RUN php artisan key:generate

# Migrate the database
RUN php artisan migrate

# continue stage build with the desired image and copy the source including the
# dependencies downloaded by composer
FROM trafex/php-nginx
# Configure nginx
COPY nginx.conf /etc/nginx/nginx.conf
USER root
RUN apk add --no-cache php81-tokenizer php81-pdo php81-pdo_mysql

USER nobody

EXPOSE 3030

COPY --chown=nobody --from=composer /app /var/www/html