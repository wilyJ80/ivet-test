#!/bin/bash

# Installations
sudo apt update
sudo apt install -y apache2 php php-mysql mysql-server unzip


# Unpacking database
#
unzip ivetune_geral.zip
mv ivetune_geral.sql public_html/

# Setting up MySQL
#
# Make sure that NOBODY can access the server without a password
mysql -e "UPDATE mysql.user SET Password = PASSWORD('CHANGEME') WHERE User = 'root'"
# Kill the anonymous users
mysql -e "DROP USER ''@'localhost'"
# Because our hostname varies we'll use some Bash magic here.
mysql -e "DROP USER ''@'$(hostname)'"
# Kill off the demo database
mysql -e "DROP DATABASE test"
# Make our changes take effect
mysql -e "FLUSH PRIVILEGES"
# Any subsequent tries to run queries this way will get access denied because lack of usr/pwd param
#
#
mysql -e "GRANT ALL ON *.* TO 'admin'@'localhost' IDENTIFIED BY 'password' WITH GRANT OPTION"
mysql -e "FLUSH PRIVILEGES"
