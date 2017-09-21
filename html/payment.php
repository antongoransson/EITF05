<?php
session_start();
include 'connect.php';
?>

<html>
<head>
	<title> Betalning </title>
</head>
<body>
	<section>
	<form id=payment action="/payment/receipt.php" method="post">
		<h1> Betalningsinformation för <?php echo htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8')?></h1>
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
			<?php echo $db->getAddress($_SESSION['username'])?>

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
		</fieldset>
		<fieldset >
			<form action='receipt.php'>
				<button type=submit>Betala</button>
			</form>
			<form action='index.php'style=display:inline-block;>
				<button type=submit>Avbryt</button>
			</form>

		</fieldset>
	</form>
	</section>

</body>
</html>
