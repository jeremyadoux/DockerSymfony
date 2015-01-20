<?php

$container->setParameter('database_host_env', "mysql"/*$_ENV['MYSQL_PORT_3306_TCP_ADDR']*/);
$container->setParameter('database_name_env', "symfony2"/*$_ENV['MYSQL_ENV_MYSQL_DATABASE']*/);
$container->setParameter('database_user_env', "symfony"/*$_ENV['MYSQL_ENV_MYSQL_USER']*/);
$container->setParameter('database_password_env', "symfony"/*$_ENV['MYSQL_ENV_MYSQL_PASS']*/);

/*
$container->loadFromExtension('parameters', array(
  'database_host_env' => $_ENV['MYSQL_PORT_3306_TCP_ADDR'],
  'database_name_env' => $_ENV['MYSQL_ENV_MYSQL_DATABASE'],
  'database_user_env' => $_ENV['MYSQL_ENV_MYSQL_USER'],
  'database_password_env' => $_ENV['MYSQL_ENV_MYSQL_PASS'],
));
*/
