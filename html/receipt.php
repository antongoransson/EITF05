<?php
  session_start();
  require 'connect.php';
  if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'])
  	echo "<script> window.location = 'index.php'; </script>";
  $s = $_SESSION['cart'];
  $db->putOrder( $_SESSION['username'], $_SESSION['cart']);
  unset($_SESSION["cart"]);
?>
