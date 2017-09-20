<?php
  require 'vendor/autoload.php';
  use SQL\MySQLConnection;
  use SQL\db;


  $pdo = (new MySQLConnection())->connect();
  $db = new DB($pdo);
?>
