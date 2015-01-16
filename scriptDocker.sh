#!/bin/bash
ENV DEBIAN_FRONTEND noninteractive

sudo apt-get update
sudo curl -sSL https://get.docker.com/ubuntu/ | sudo sh

sudo docker build -t tutum/apache-php /vagrant/Docker/apachephp
sudo docker build -t tutum/mysql /vagrant/Docker/mysql
sudo docker build -t visiativ/mailcatcher /vagrant/Docker/mailcatcher

sudo docker run -d -p 3306:3306 --name mysql -v /home/vagrant/mysql:/var/lib/mysql -e MYSQL_USER=symfony -e MYSQL_PASS=symfony -e MYSQL_DATABASE=symfony2 tutum/mysql
sudo docker run -d -p 1080:1080 --name mailcatcher visiativ/mailcatcher
sudo docker run -d -p 80:80 -p 9015:9015 -p 2223:22 -v /home/vagrant/html:/app --link mysql:mysql --name apachephp tutum/apache-php

