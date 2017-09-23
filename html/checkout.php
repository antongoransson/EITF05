<?php
	session_start();
	require'connect.php';
	include 'navbar.php'
?>
<html>
	<head>
		<title> Checkout </title>
	  <link rel="stylesheet" href="styles.css">
	</head>
	<body style=margin-top:60px>
		<h1> Checkout<?php
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
		 echo " för ".htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8');
		 ?>
	 </h1>
		<?php echo '<a href="index.php">Fortsätt shoppa</a>'; ?>
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
			if(!empty($_SESSION["cart"])){
				$total = 0;
				$all_item_info = $db->getItems();
				foreach($_SESSION["cart"] as $id => $amount){
					$item_info = array();
					foreach($all_item_info as $item){
						if ($item["itemid"] == $id) {
							$item_info = $item;
							break;
						}
					}
		?>
		<tr>
			<td><?= $item_info["name"]; ?></td>
			<td><?= $amount; ?></td>
			<td><?= $item_info["price"]; ?> kr</td>
			<td><?= number_format($amount * $item_info["price"], 2); ?> kr</td>
			<td>
				<form action="shop.php" method="post">
					<input type="hidden" name="itemid" value="<?= $id; ?>">
					<input type="submit" name="delete" value="Ta bort" />
				</form>
			</td>
		</tr>
	<?php
			$total = $total + ($amount * $item_info["price"]);
		}
	?>
		<tr>
			<td colspan="4" align="right">Totalt: <?= number_format($total, 2); ?> kr</td>

			<td></td>
		</tr>
		<?php
		}
		?>
		</table>
		<br>
		<?php
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
			?>
			<form action=payment.php>
				<button type="submit" class="btn btn-default">Till betalning</button>
			</form>
		<?php
	} else {
		?>
			<button type="submit" class="btn btn-default"title="Var vänlig logga in för att betala" disabled >Till betalning</button>
	<?php
}?>
	</body>
</html>
