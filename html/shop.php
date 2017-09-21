<?php
session_start();
require'connect.php';
if(isset($_POST["add"]))
{
	if(isset($_SESSION["cart"]))
	{
		$item_array_id = array_column($_SESSION["cart"], "product_id");

			$count = count($_SESSION["cart"]);
			$item_array = array(
			'product_id' => $_POST["itemid"],
			'item_name' => $_POST["hidden_name"],
			'product_price' => $_POST["hidden_price"],
			'item_quantity' => $_POST["nbrOfItems"]
			);
			$_SESSION["cart"][$count] = $item_array;
			echo '<script>window.location="index.php"</script>';

	}
	else
	{
		$item_array = array(
		'product_id' => $_GET["itemid"],
		'item_name' => $_POST["hidden_name"],
		'product_price' => $_POST["hidden_price"],
		'item_quantity' => $_POST["nbrOfItems"]
		);
		$_SESSION["cart"][0] = $item_array;
	}
}
if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["cart"] as $keys => $values)
		{
			if($values[hidden_name] == $_GET[name])
			{
				unset($_SESSION["cart"][$keys]);
				echo '<script>alert("Varan har blivit borttagen")</script>';
				echo '<script>window.location="checkout.php"</script>';
			}
		}
	}
}
?>
