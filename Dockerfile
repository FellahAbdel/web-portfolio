# Utilisation de l'image officielle PHP avec Apache
FROM php:8.2-apache

# Installation des extensions PHP nécessaires (PDO MySQL)
RUN docker-php-ext-install pdo_mysql

# Activation du module de réécriture d'Apache (mod_rewrite)
RUN a2enmod rewrite

# Définition du répertoire de travail interne au conteneur
WORKDIR /var/www/html

# Copie des fichiers du projet dans le conteneur
COPY . /var/www/html/

# Ajustement des permissions pour Apache
RUN chown -R www-data:www-data /var/www/html

# Exposition du port 80
EXPOSE 80
