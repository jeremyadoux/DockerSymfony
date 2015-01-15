VAGRANTFILE_API_VERSION = "2"
 
Vagrant.configure("2") do |config|
  config.vm.define "mysql" do |a|
    a.vm.provider "docker" do |d|
	  d.build_dir = "./Docker/mysql/"
	  d.volumes = ["/home/vagrant/mysql:/var/lib/mysql"]
      d.ports = ["3306:3306"]
      d.name = "mysql"
	  d.env = {
          MYSQL_USER: "symfony",
          MYSQL_PASS: "symfony",
          MYSQL_DATABASE: "symfony2"
      }
	  d.vagrant_machine = "dockerhost"
	  d.vagrant_vagrantfile = "./DockerHostVagrantfile"
    end
  end

  config.vm.define "mailcatcher" do |a|
      a.vm.provider "docker" do |d|
  	  d.build_dir = "./Docker/mailcatcher/"
      d.ports = ["1080:1080"]
      d.name = "mailcatcher"
  	  d.vagrant_machine = "dockerhost"
  	  d.vagrant_vagrantfile = "./DockerHostVagrantfile"
      end
    end
  
  config.vm.define "apachephp" do |a|
    a.vm.provider "docker" do |d|
	  d.build_dir = "./Docker/apachephp/"
      d.ports = ["80:80", "9015:9015"]
	  d.volumes = ["/home/vagrant/html:/app"]
      d.name = "apachephp"
	  d.vagrant_machine = "dockerhost"
	  d.link("mysql:mysql")
	  d.link("mailcatcher:mailcatcher")
	  d.vagrant_vagrantfile = "./DockerHostVagrantfile"
    end
  end
end