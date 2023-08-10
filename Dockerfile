FROM composer AS composer

ENV APP_URL=http://0.0.0.0:3030

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
RUN php artisan config:clear

# RUN php artisan migrate

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

# Run migrations here
CMD [ "/bin/sh", "-c" , "php artisan migrate;/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf"]