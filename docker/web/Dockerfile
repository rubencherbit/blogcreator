FROM php:5.6-apache

RUN apt-get update && apt-get -y install libxml2-dev gettext

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pdo \
    pdo_mysql \
    mbstring \
    tokenizer \
    xml

RUN a2enmod rewrite

ADD run.sh /

RUN chmod +x /run.sh

ADD files /

CMD /run.sh