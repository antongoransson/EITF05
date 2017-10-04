<?php
session_start();
require_once realpath('../csrf.php');
require realpath('../connect.php');

$currpage = "checkout.php";
include realpath('../navbar.php');
include 'shop.php'
?>
<html>
	<head>
		<title> Checkout </title>
	  <link rel="stylesheet" href="../css/index.css">
	</head>
	<body style=margin-top:60px>
		<h1> Checkout<?php
		if (isset($_SESSION['username']))
		 echo " för ".htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8');
		 ?>
	 </h1>
		<br><br>
		<table >
			<tr>
				<th>Produkt</th>
				<th>Antal</th>
				<th>Pris</th>
				<th>Total</th>
				<th></th>
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
				<form method="post">
					<input type="hidden" name="itemid" value="<?= $id; ?>">
					<?php echo csrf_input_tag();?>
					<button type="remove" name="delete" value="Ta bort">Ta bort </button>
				</form>
			</td>
		</tr>
	<?php
			$total+= ($amount * $item_info["price"]);
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
			if (isset($_SESSION['username']) && isset($_SESSION['cart'])) {
		?>
			<form action=../payment>
				<button type="submit" class="checkoutbtn">Till betalning</button>
				<?= csrf_input_tag()?>
			</form>
		<?php
	} else {
		?>
		<button
			type="submit"
			class="checkoutbtn"
			title="Var vänlig logga in eller lägg till varor för att betala"
		 	disabled >Till betalning
		</button>
	<?php
}?>
	</body>
</html>
