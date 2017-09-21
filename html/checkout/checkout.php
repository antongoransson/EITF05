<?php
session_start();
require'../connect.php';
?>
<html>
<head>

	<title> Checkout </title>
	<style>
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th, td {
		padding: 5px;
	}
	th {
		text-align: left;
	}
	</style>
</head>
<body>
	<h1> Checkout för <?php echo htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8')?></h1>
<?php
if(!$_SESSION["loggedIn"]) {
	echo '<a href="login">Login</a>'.'<br>';
	echo '<a href="register">Register</a>';
} else
	echo '<a href="/login/logoutscript.php">Logout</a>';
?>
	<?php echo '<a href="../index.php">Fortsätt shoppa</a>'; ?>
	<br><br>
<table style="width:100%">
		<tr>
		<th>Produkt</th>
		<th>Antal</th>
		<th>Pris</th>
		<th>Total</th>
		<th>Ta bort</th>
		</tr>
<?php
if(!empty($_SESSION["cart"]))
{
	$total = 0;
	$all_item_info = $db->getItems();
	foreach($_SESSION["cart"] as $id => $amount)
	{
		$item_info = Array();
		foreach($all_item_info as $item)
		{
			if ($item["itemid"] == $id) {
				$item_info = $item;
				break;
			}
		}
?>
		<tr>
		<td><?php echo $item_info["name"]; ?></td>
		<td><?php echo $amount; ?></td>
		<td><?php echo $item_info["price"]; ?> kr</td>
		<td><?php echo number_format($amount * $item_info["price"], 2); ?> kr</td>
		<td>
			<form action="shop.php" method="post">
				<input type="hidden" name="itemid" value="<?php echo $id; ?>">
				<input type="submit" name="delete" value="ta bort" />
			</form>
		</td>
		</tr>
<?php 
		$total = $total + ($amount * $item_info["price"]);
	}
?>
	<tr>
	<td colspan="4" align="right">Totalt: <?php echo number_format($total, 2); ?> kr</td>

	<td></td>
	</tr>
<?php
}
?>
</table>
</div>
</div>
<br><br>
<button type="submit" class="btn btn-default">Till betalning</button>
</body>
</html>


