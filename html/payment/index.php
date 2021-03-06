<?php
session_start();
	require_once realpath('../csrf.php');
	require realpath('../connect.php');
	if(!isset($_SESSION['username']) || !isset($_SESSION['cart']) || !csrf_check($_GET['csrf']))
		echo "<script> window.location = '../'; </script>";
	if(isset($_POST["csrf"]) && csrf_check($_POST["csrf"])){
		$_SESSION["payed"] = true;
		echo "<script> window.location = '../receipt'; </script>";
	}
?>

<html>
<head>
	<title> Betalning </title>
</head>
<body>
	<section>
	<form method=post>
		<h1> Betalningsinformation för <?= htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8')?></h1>
		<fieldset>
			<label for=email>Email:</label><br>
			<input id=email name=email type=email placeholder="example@domain.com" required />	<br>
			<br>
			<label for=phone>Telefon:</label><br>
			<input id=phone name=phone type=tel placeholder="0123456789" />

		</fieldset>
		<fieldset>
            <legend>Leveransadress</legend>
			<!-- printa den adress som finns i db -->
			<?= $db->getAddress($_SESSION['username'])?>

		</fieldset>
		<fieldset>
			<legend>Kortdetaljer</legend>
				<fieldset>
				<legend>Korttyp</legend>
					<input id=visa name=cardtype type=radio />
					<label for=visa>VISA</label>
					<input id=mastercard name=cardtype type=radio />
					<label for=mastercard>Mastercard</label>
				</fieldset>
				<label for=cardnumber>Kortnummer</label><br>
				<input id=cardnumber name=cardnumber type=number placeholder="1234123412341234" required /><br>
				<br>
				<label for=expirationdate>Giltlighetstid</label><br>
				<input id=expirationmonth name=expirationmonth type=number placeholder="01" required />
				<input id=expirationyear name=expirationyear type=number placeholder="20" required /> <br>
				<br>
				<label for=cvc>CVC</label><br>
				<input id=cvc name=cvc type=nummer placeholder="000" required /><br>
				<br>
				<label for=cardname>Namn på kortet</label><br>
				<input id=cardname name=cardname placeholder="Sam Morris" required /> <br>
				<input type=hidden name=payment value="val"/> <br>
		</fieldset>
		<fieldset >
			<button type=submit>Betala</button>
			<button type=button onclick=history.back()>Avbryt</button>
		</fieldset>
		<?= csrf_input_tag() ?>
	</form>
	</section>

</body>
</html>
