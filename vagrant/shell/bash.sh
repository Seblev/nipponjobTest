#!/bin/sh

sudo apt-get install -y vim dos2unix

sudo sed -i 's/#force_color_prompt/force_color_prompt/g' /home/vagrant/.bashrc
sudo sed -i 's/#alias/alias/g' /home/vagrant/.bashrc

dos2unix /vagrant/vagrant/dot/vimrc

cp /vagrant/vagrant/dot/vimrc ~/.vimrc
cp /vagrant/vagrant/dot/vimrc /home/vagrant/.vimrc
sudo apt-get install xclip
cd /var/www/