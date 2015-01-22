#!/bin/bash
env | grep _ >> /etc/environment
chown www-data:www-data /app -R
source /etc/apache2/envvars
/etc/init.d/ssh start
exec apache2 -D FOREGROUND
