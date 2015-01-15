VAGRANTFILE_API_VERSION = "2"

Vagrant.configure("2") do |config|
  config.vm.box = "phusion/ubuntu-14.04-amd64"
  config.vm.define "dockerhost"

  config.vm.network "private_network", ip: "192.168.50.4"
  config.vm.synced_folder "./html" , "/home/vagrant/html", :mount_options => ["dmode=777", "fmode=666"]
  config.vm.synced_folder "./mysql" , "/home/vagrant/mysql", :mount_options => ["dmode=777", "fmode=666"]
  config.vm.network "forwarded_port", guest: 80, host: 80
  config.vm.network "forwarded_port", guest: 1080, host: 1080
  
  config.vm.provider :virtualbox do |vb|
      vb.name = "dockerhost"
	  vb.memory = 2048
	  vb.cpus = 2
  end

  config.vm.provision "shell", path: "scriptDocker.sh"
end