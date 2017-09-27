<?php
  require_once dirname(__FILE__).'/sql/MySQLConnection.php';
  require_once dirname(__FILE__).'/sql/db.php';
  $db = new DB((new MySQLConnection())->connect());
?>
