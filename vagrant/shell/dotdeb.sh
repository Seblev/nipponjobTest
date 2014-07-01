#!/bin/sh

sudo cp /var/www/vagrant/dot/dotdeb.list /etc/apt/sources.list.d/

wget http://www.dotdeb.org/dotdeb.gpg
sudo apt-key add dotdeb.gpg
sudo apt-get update
