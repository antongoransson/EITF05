<?php
session_start();
if (isset($_POST["delete"])) {
	$id = $_POST["itemid"];
	if (isset($id)) {
		unset($_SESSION["cart"][$id]);
	}
	echo '<script>window.location="checkout.php"</script>';
}
