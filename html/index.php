<!DOCTYPE html>
<html>
<head>
  <title>ZenCsdfsdfsdontacts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
</head>
<body>

<?php
print 'éééé@@@ààà';
var_dump($_SERVER);
var_dump($_ENV);

$servername = $_ENV['MYSQL_PORT_3306_TCP_ADDR'];
$username = "symfony";
$password = "symfony";

try {
    $conn = new PDO("mysql:host=$servername;dbname=symfony2", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>
</body>
</html>