#!/bin/sh

sudo apt-get update

echo mysql-server mysql-server/root_password select "nipponad" | debconf-set-selections
echo mysql-server mysql-server/root_password_again select "nipponad" | debconf-set-selections

echo "Installing LAMP..."

sudo apt-get install -y curl mysql-server apache2 php5 libapache2-mod-php5 php5-mysql php5-cli \
php5-curl php5-gd php5-intl php5-mcrypt php5-sqlite php5-xdebug php5-apc bash-completion


#sudo echo "suhosin.executor.include.whitelist = phar" >> /etc/php5/cli/conf.d/suhosin.ini
sudo sed -i 's#;date.timezone =#date.timezone = Europe/Paris#g' /etc/php5/apache2/php.ini
sudo sed -i 's#;date.timezone =#date.timezone = Europe/Paris#g' /etc/php5/cli/php.ini

echo "Add symfony2 AutoComplete..."
sudo wget -O /etc/bash_completion.d/symfony2-autocomplete.bash https://raw.github.com/KnpLabs/symfony2-autocomplete/master/symfony2-autocomplete.bash

echo "Installing composer..."
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

echo "Activate Apache module"
sudo a2enmod rewrite
sudo a2enmod expires
sudo service apache2 restart

echo "Configurate MYSQL"
sudo sed -i 's/127.0.0.1/0.0.0.0/g' /etc/mysql/my.cnf
mysql -u root -p"nipponad" < /var/www/vagrant/dot/databases.sql

sudo service mysql restart

sudo apt-get clean


echo "Configuration du projet"
sudo cp /vagrant/vagrant/dot/dev.nipponjob.com.conf /etc/apache2/sites-available/
cd /etc/apache2/sites-enabled/
ln -s ../sites-available/dev.nipponjob.com.conf
cd ~
sudo service apache2 restart



