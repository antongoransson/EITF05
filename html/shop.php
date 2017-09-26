<?php
session_start();
if (isset($_POST["delete"])) {
	$id = $_POST["itemid"];
	if (isset($id)) {
		unset($_SESSION["cart"][$id]);
		if (count($_SESSION["cart"]) == 0 ) {
			unset($_SESSION["cart"]);
		}
	}

	echo '<script>window.location="checkout.php"</script>';
}
