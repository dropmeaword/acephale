# -*- mode: ruby -*-
# vi: set ft=ruby :

# General project settings
#################################

# see: https://github.com/patrickdlee/vagrant-examples/blob/master/example6/Vagrantfile
# for multi-machine setup

# IP Address for the host only network, change it to anything you like
# but please keep it within the IPv4 private network range
ip_address = "172.22.22.110"

# The project name is base for directories, hostname and alike
project_name = "acephale"

Vagrant.configure("2") do |config|
    config.vm.usable_port_range = 1337..1400  
	config.vm.box = "cargomedia/debian-7-amd64-default"

	# guest httpd
	config.vm.network :forwarded_port, guest: 8080, host: 8080
	config.vm.network :forwarded_port, guest: 8088, host: 8088

    config.vm.network :forwarded_port, guest: 22, host: 2223, id: "ssh", auto_correct:true
	# Set share folder
	config.vm.synced_folder "." , "/var/www/" + project_name + "/", :mount_options => ["dmode=777", "fmode=777"]

	# Use hostonly network with a static IP Address and enable
	# hostmanager so we can have a custom domain for the server
	# by modifying the host machines hosts file
	config.hostmanager.enabled = true
	config.hostmanager.manage_host = true
	config.vm.define project_name do |node|
	  node.vm.hostname = project_name + ".local"
	  node.vm.network :private_network, ip: ip_address, virtualbox__intnet: "test" 
	  node.hostmanager.aliases = [ "www." + project_name + ".local" ]
	end

	config.vm.provision :hostmanager

	config.vm.provision "shell", path: "provision/provision"
end
