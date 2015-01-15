vagrant up --no-parallel

config.vm.define "redis" do |a|
    a.vm.provider "docker" do |d|
	  d.build_dir = "./Docker/redis/"
      d.ports = ["6379:6379"]
      d.name = "redis"
	  d.vagrant_machine = "dockerhost"
	  d.env = {REDIS_PASS: "tempo"}
	  d.vagrant_vagrantfile = "./DockerHostVagrantfile"
    end
  end

  config.vm.define "activemq" do |a|
    a.vm.provider "docker" do |d|
	  d.build_dir = "./Docker/activeMQ/"
      d.ports = ["6155:6155"]
	  d.ports = ["6156:6156"]
	  d.ports = ["61616:61616"]
	  d.ports = ["61617:61617"]
	  d.ports = ["1099:1099"]
	  d.ports = ["8161:8161"]
      d.name = "activemq"
	  d.vagrant_machine = "dockerhost"
	  d.env = {REDIS_PASS: "tempo"}
	  d.vagrant_vagrantfile = "./DockerHostVagrantfile"
    end
  end