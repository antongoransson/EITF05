<?php
session_start();
require'../connect.php';
if (isset($_POST["add"])) {
	$_SESSION["cart"][$_POST["itemid"]] += $_POST["nbrOfItems"];
	echo '<script>window.location="../index.php"</script>';
} else if (isset($_POST["delete"])) {
	$id = $_POST["itemid"];
	if (isset($id)) {
		unset($_SESSION["cart"][$id]);
	}
	echo '<script>window.location="../checkout/checkout.php"</script>';
}
