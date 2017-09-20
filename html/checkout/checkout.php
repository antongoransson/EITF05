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
		foreach($_SESSION["cart"] as $keys => $values)
		{
	?>
            <tr>
            <td><?php echo $values["item_name"]; ?></td>
            <td><?php echo $values["item_quantity"] ?></td>
            <td><?php echo $values["product_price"]; ?> kr</td>
            <td><?php echo number_format($values["item_quantity"] * $values["product_price"], 2); ?> kr</td>
            <td><a href="shop.php?action=delete&id=<?php echo $values["product_id"]; ?>"><span class="text-danger">Ta bort</span></a></td>
            </tr>
            <?php 
			$total = $total + ($values["item_quantity"] * $values["product_price"]);
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

	