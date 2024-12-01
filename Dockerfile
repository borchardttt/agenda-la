# Usar a imagem base do PHP 8.3 com FPM
FROM php:8.3-fpm

# Atualizar os pacotes e instalar as dependências necessárias
RUN apt-get update && \
    apt-get install -y libmariadb-dev && \
    docker-php-ext-install pdo pdo_mysql

# Defina o diretório de trabalho
WORKDIR /var/www
