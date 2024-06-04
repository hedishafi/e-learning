# Use official PHP image
FROM php:7.4-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the PHP application files to the container
COPY . .
COPY .env .env

# Expose port 80 to the outside world
EXPOSE 80


