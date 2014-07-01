# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.box = "debian-squeeze607-x64-vbox43"
  #config.vm.box = "DebianSqueeze64"
  config.vm.box_url = "http://public.sphax3d.org/vagrant/squeeze64.box"
  
  config.vm.provision :shell, :path => "vagrant/shell/dotdeb.sh"
  config.vm.provision :shell, :path => "vagrant/shell/lamp.sh"
  config.vm.provision :shell, :path => "vagrant/shell/git.sh"
  config.vm.provision :shell, :path => "vagrant/shell/bash.sh"

  config.vm.network "private_network", ip: "192.168.6.66"
  config.vm.synced_folder "./", "/var/www"
  
  config.vm.usable_port_range = (2200..2250)
  config.vm.provider :virtualbox do |v|
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    v.customize ["modifyvm", :id, "--cpus", 2]
    v.customize ["modifyvm", :id, "--ioapic", "on"]
    v.customize ["modifyvm", :id, "--memory", 2048]
    v.customize ["modifyvm", :id, "--name", "nipponVM"]
	v.customize ["setextradata", :id, "--VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]
  end
  
  config.ssh.username = "vagrant"
  config.ssh.shell = "bash -l"
  config.ssh.forward_agent = true
  config.ssh.forward_x11 = false
  config.vagrant.host = :detect

end
