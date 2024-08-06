FROM archlinux

# Install MariaDB, PHP, and other required packages
RUN pacman -Sy --noconfirm mariadb mariadb-clients php php-fpm sudo

# Create a new user and set its password
RUN useradd -m -s /bin/bash newuser && \
    echo 'newuser:newuserp9000' | chpasswd && \
    echo 'newuser ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Initialize the MariaDB data directory
RUN mariadb-install-db --user=mysql --basedir=/usr --datadir=/var/lib/mysql

# Copy the SQL file and PHP files into the container
COPY ivetune_geral.sql /docker-entrypoint-initdb.d/
COPY public_html /var/www/html

# Expose the MariaDB and PHP-FPM ports
EXPOSE 3306 9000

# Start MariaDB, initialize the database, and then start PHP-FPM
CMD /bin/sh -c " \
    # Start MariaDB server \
    mysqld_safe --datadir=/var/lib/mysql & \
    sleep 10 && \
    mysqladmin ping && \
    # Source the SQL file into MariaDB \
    mysql < /docker-entrypoint-initdb.d/ivetune_geral.sql && \
    # Start PHP-FPM \
    # php-fpm --nodaemonize \
    php -S 0.0.0.0:8000 -t /var/www/html"
