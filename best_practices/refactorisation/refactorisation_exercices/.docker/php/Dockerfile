FROM php:8.2-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN chmod -R 777 /home \
	&& chown -R 1000:1000 /home

WORKDIR /home/refactorisation_exercices



RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
RUN mkdir /.symfony5 \
	&& chown 1000:1000 /.symfony5
RUN mkdir /.composer \
	&& chown 1000:1000 /.composer
