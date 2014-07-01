#!/bin/sh

echo "Installation de Symfony 2.5"
composer create-project symfony/framework-standard-edition ../ "2.5.*"

echo "Paramétrage des droits d'accès"
rm -rf ../app/cache/*
rm -rf ../app/logs/*

chmod 777 ../app/cache
chmod 777 ../app/logs

echo "Paramétrage php pour symfony"
sudo sed -i "s/short_open_tag = On/short_open_tag = Off/" /etc/php5/apache2/php.ini
sudo sed -i "s/short_open_tag = On/short_open_tag = Off/" /etc/php5/cli/php.ini