#!/bin/sh

echo "Installation de Symfony 2.5"
composer create-project symfony/framework-standard-edition path/ "2.5.*"

echo "Paramétrage des droits d'accès"
rm -rf app/cache/*
rm -rf app/logs/*

chmod 777 app/cache
chmod 777 app/logs