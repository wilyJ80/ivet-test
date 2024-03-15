# ivet

# Dependencies (according to creator)

- php 7.3.7
- apache 2.4.39
- mysql
- html, css, jquery, java
- ???

# Dependencies used on localhost test

`sudo apt install mysql-server`

`sudo apt install apache2`

`sudo apt install php`

`sudo apt install php-mysql`

Everything on Ubuntu

# add line below <?php in index.php and grafico.php:

`ini_set('user_ini.filename', '/path/to/your/application/php.ini');`

- custom php.init was set correctly. file added

# database credentials changed. ???

# SQL CLI commands:
`sql -u root`

`SHOW DATABASES;`

`USE ivetune_geral;`

`source ./ivetune_geral.sql;`

# PAGE ONLY LOADS IF %this->servidor = "127.0.0.1:3306" is used and localhost:8080 is the opened host/port
- ???

# MySQL Command to change password, this was needed and the FINAL STEP
`ALTER USER 'root'@'localhost' IDENTIFIED BY '';`

# php.ini was added to add pdo-mysqli and related extensions, try not using it

# Then it works.
# Check this fork for currently modified code. Needs use to see if it works...
