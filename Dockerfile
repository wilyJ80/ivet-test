FROM archlinux

# Install MariaDB, PHP, and required PHP extensions
RUN pacman -Sy --noconfirm mariadb mariadb-clients php sudo

# Create a new user and set its password
RUN useradd -m -s /bin/bash newuser && \
    echo 'newuser:newuserp9000' | chpasswd && \
    echo 'newuser ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Initialize the MariaDB data directory
RUN mariadb-install-db --user=mysql --basedir=/usr --datadir=/var/lib/mysql

# Copy the SQL file and PHP files into the container
COPY ivetune_geral.sql /docker-entrypoint-initdb.d/
COPY public_html /var/www/html

# Copy a custom php.ini configuration file if needed
COPY php.ini /etc/php/php.ini

# Expose the ports for MariaDB and the PHP server
EXPOSE 3306 8000

# Add a custom entrypoint script to manage the services
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Run the entrypoint script
ENTRYPOINT ["/entrypoint.sh"]
