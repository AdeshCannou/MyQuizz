# Utilisez une image PHP avec Apache préinstallé
FROM php:7.4-apache

# Installation des dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo_mysql zip

# Installe Composer globalement
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Activer le module Apache mod_rewrite
RUN a2enmod rewrite

# Configuration du virtual host Apache
COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application dans le conteneur
COPY . .

# Installer les dépendances de l'application Symfony
RUN composer install --no-interaction

# Exposer le port 80
EXPOSE 80

# Commande de démarrage d'Apache
CMD ["apache2-foreground"]
