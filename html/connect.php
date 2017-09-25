<?php
  require 'vendor/autoload.php';
  use SQL\MySQLConnection;
  use SQL\db;
  $db = new DB((new MySQLConnection())->connect());
?>
