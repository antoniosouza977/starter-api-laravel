FROM php:8.3-cli

# Instala dependências necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo_mysql

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define o diretório de trabalho para a aplicação Laravel
WORKDIR /var/www

# Copia o código fonte da aplicação Laravel para o contêiner
COPY . /var/www

COPY ./docker/scripts/install-app.sh /usr/local/bin/install-app

# Exponhe a porta 9000 para o servidor PHP-FPM
EXPOSE 8000

# Inicia o servidor PHP-FPM
CMD ["/usr/local/bin/install-app"]
