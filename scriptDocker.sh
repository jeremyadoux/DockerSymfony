#!/bin/bash
sudo apt-get update
sudo curl -sSL https://get.docker.com/ubuntu/ | sudo sh

sudo mkdir /home/vagrant/html
sudo chown -R vagrant: /home/vagrant/html
sudo chmod -R 777 /home/vagrant/html
sudo chown -R vagrant: /home/vagrant/html

sudo docker build -t tutum/apache-php /vagrant/Docker/apachephp
sudo docker build -t tutum/mysql /vagrant/Docker/mysql
sudo docker build -t visiativ/mailcatcher /vagrant/Docker/mailcatcher

sudo docker rm -f mysql
sudo docker rm -f apachephp
sudo docker rm -f mailcatcher

sudo docker run -d -p 3306:3306 --name mysql -v /home/vagrant/mysql:/var/lib/mysql -e MYSQL_USER=symfony -e MYSQL_PASS=symfony -e MYSQL_DATABASE=symfony2 tutum/mysql
sudo docker run -d -p 1080:1080 --name mailcatcher visiativ/mailcatcher
sudo docker run -d -p 80:80 -p 9015:9015 -p 2223:22 -v /home/vagrant/html:/app --link mysql:mysql --link mailcatcher:mailcatcher --name apachephp tutum/apache-php

