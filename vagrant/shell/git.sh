#!/bin/sh

sudo apt-get install -y git bash-completion fontconfig

echo "Initialisation de GIT FLOW"

git clone --recursive git://github.com/nvie/gitflow.git
cd gitflow
sudo make install
cd ..

sudo wget --no-check-certificate -O /etc/bash_completion.d/git-flow-completion.bash https://raw.github.com/bobthecow/git-flow-completion/master/git-flow-completion.bash

git config --global --add color.ui true
sudo -u vagrant git config --global --add color.ui true