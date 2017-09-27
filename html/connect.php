<?php
  require_once dirname('./').'/sql/MySQLConnection.php';
  require_once dirname('./').'/sql/db.php';
  $db = new DB((new MySQLConnection())->connect());
?>
