# Use an official PHP image as the base image
FROM php:7.4-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the application source files into the container
COPY . /var/www/html

# Install any PHP extensions or dependencies (if needed)
# RUN apt-get update && apt-get install -y ...

# Expose the port your web server is running on
EXPOSE 80

# Start the web server
CMD ["apache2-foreground"]
