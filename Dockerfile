# Use an official PHP image as the base image
FROM php:7.3.7-apache

# Install the PHP extensions and dependencies your application needs
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy your application code into the container
COPY ./public_html /var/www/html

# Expose the necessary ports
EXPOSE 80

# Start the web server
CMD ["apache2-foreground"]

