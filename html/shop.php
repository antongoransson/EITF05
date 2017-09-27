<?php
session_start();
if (isset($_POST["delete"])) {
	$id = $_POST["itemid"];
	if (isset($id) && csrf_check($_POST['csrf'])) {
		unset($_SESSION["cart"][$id]);
	}
	echo '<script>window.location="checkout.php"</script>';
}
