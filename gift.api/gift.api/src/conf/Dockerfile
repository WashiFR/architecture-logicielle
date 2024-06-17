# Utiliser une image de base officielle de PHP avec Apache
FROM php:8.2-apache

# Copier les fichiers de l'application dans le répertoire de l'application dans le conteneur
COPY src/ /var/www/html/

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql