<?php
if (isset($_POST["delete"])) {
	$id = $_POST["itemid"];
	if (isset($id) && csrf_check($_POST['csrf'])) {
		unset($_SESSION["cart"][$id]);
		if (count($_SESSION["cart"]) == 0 ) {
			unset($_SESSION["cart"]);
		}
	}
	echo '<script>window.location="/checkout"</script>';
}
