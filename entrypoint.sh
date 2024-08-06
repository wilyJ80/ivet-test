#!/bin/bash

# Start MariaDB in the background
mariadbd-safe --datadir=/var/lib/mysql &

# Wait for MariaDB to start
until mysqladmin ping --silent; do
    sleep 1
done

# Create the database, user, and grant privileges
mysql -e "CREATE DATABASE IF NOT EXISTS your_database_name;"
mysql -e "CREATE USER IF NOT EXISTS 'newuser'@'%' IDENTIFIED BY 'newuserp9000';"
mysql -e "GRANT ALL PRIVILEGES ON your_database_name.* TO 'newuser'@'%';"
mysql -e "FLUSH PRIVILEGES;"

# Initialize the database and load the SQL file
mysql -u newuser -pnewuserp9000 your_database_name < /docker-entrypoint-initdb.d/ivetune_geral.sql

# Start the PHP server
php -S 0.0.0.0:8000 -t /var/www/html
