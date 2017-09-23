<?php
  session_start();
  require 'connect.php';
  if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'])
  	echo "<script> window.location = 'index.php'; </script>";
  $s = $_SESSION['cart'];
  $db->putOrder( $_SESSION['username'], $_SESSION['cart']);
  // foreach ($s as $key=>$value) {
  //   # code...echo $l
  //   echo "KEY".$key.'<br>';
  //   echo "VAL".$value.'<br>';
  // }
  unset($_SESSION["cart"]);
?>
