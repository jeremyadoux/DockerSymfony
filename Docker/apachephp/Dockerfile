FROM ubuntu:trusty
MAINTAINER Fernando Mayo <fernando@tutum.co>

# Install base packages
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && \
    apt-get -yq install \
        curl \
        apache2 \
        libapache2-mod-php5 \
        php5-mysql \
		php5-xdebug \
        php5-gd \
        php5-curl \
		php5-intl \
        php-pear \
        php-apc \
        openssh-server
		
RUN sed -i "s/variables_order.*/variables_order = \"EGPCS\"/g" /etc/php5/apache2/php.ini
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add image configuration and scripts
ADD run.sh /run.sh
RUN chmod 755 /*.sh

# Configure /app folder with sample app
RUN mkdir -p /app && rm -fr /var/www/html && ln -s /app /var/www/html
ADD sample/ /app

ADD templates/xdebug.ini /etc/php5/mods-available/xdebug.ini
ADD templates/opcache.ini /etc/php5/mods-available/opcache.ini
ADD templates/symfony.conf /etc/apache2/sites-available/symfony.conf
ADD templates/php-apache.ini /etc/php5/apache2/php.ini
ADD templates/php-cli.ini /etc/php5/cli/php.ini
ADD templates/xdebug.ini /etc/php5/mods-available/xdebug.ini

RUN a2ensite symfony

EXPOSE 80
EXPOSE 22
EXPOSE 9015

RUN mkdir /var/run/sshd
RUN echo 'root:visiativ' | chpasswd
RUN sed -i 's/PermitRootLogin without-password/PermitRootLogin yes/' /etc/ssh/sshd_config

# SSH login fix. Otherwise user is kicked off after login
RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd

ENV NOTVISIBLE "in users profile"
RUN echo "export VISIBLE=now" >> /etc/profile

WORKDIR /app
CMD ["/run.sh"]
