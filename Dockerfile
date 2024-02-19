# Use a imagem oficial do PHP com Apache como base
FROM php:7.4-apache

# Instale as extensões do PHP necessárias para interagir com o MySQL
RUN echo 'instalando mysqli'
RUN docker-php-ext-install mysqli

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copie os arquivos do aplicativo PHP para o diretório de trabalho do Apache
COPY ./www/ /var/www/html/

# Configure as permissões adequadas para o Apache
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Exponha a porta 80 para o tráfego da web
EXPOSE 80

# Comando padrão para iniciar o Apache quando o contêiner for iniciado
CMD ["apache2-foreground"]
