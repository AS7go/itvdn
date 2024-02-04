# Используем официальный образ PHP 8.2 с Apache
FROM php:8.3-apache
# FROM php:8.2-apache #-не работает как нужно

# Устанавливаем расширения PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Обновление пакетов и установка инструментов
# RUN apt-get update && apt-get upgrade -y

# Установка Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer -q

# Установка Flight
# RUN composer global require flightsim/flight

# Установка Twig
# RUN composer require twig/twig

# Активируем модуль rewrite для Apache
RUN a2enmod rewrite

# Копируем исходный код приложения в контейнер
COPY . /var/www/html

# Устанавливаем права доступа к папке с приложением
RUN chown -R www-data:www-data /var/www/html

# Запускаем Apache в фоновом режиме
CMD ["apache2-foreground"]
