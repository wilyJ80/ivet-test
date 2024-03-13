# ivet

# Dependencies

- php 7.3.7
- apache 2.4.39
- mysql
- html, css, jquery, java
- ???

# Commands actually used

sudo apt install sql-server
sudo apt install apache2
sudo apt install php
sudo apt install php-mysql

# add line below <?php in index.php and grafico.php:

ini_set('user_ini.filename', '/path/to/your/application/php.ini');

- custom php.init was set correctly. file added

# database credentials changed. ???

# SQL CLI commands:
sql -u root
SHOW DATABASES;
USE ivetune_geral;
source ./ivetune_geral.sql;

# PAGE ONLY LOADS IF %this->servidor = "127.0.0.1:3306" is used and localhost:8080 is the opened host/port

# MySQL Command to change password
ALTER USER 'root'@'localhost' IDENTIFIED BY 'newpassword';

# Then it works.
