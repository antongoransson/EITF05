<html>
<head>
	<title> Betalning </title>
</head> 
<body> 
	<section>
	<form id=payment>
		<h1> Betalningsinformation</h1>
		<fieldset>	
			<label for=email>Email</label>
			<input id=email name=email type=email placeholder="example@domain.com" required />	<br>
			
			<label for=phone>Telefon</label>
			<input id=phone name=phone type=tel placeholder="0123456789" />	
			
		</fieldset>
		<fieldset>
            <legend>Leveransadress</legend>
			<!-- printa den adress som finns i db -->
			<?php echo htmlspecialchars($_SESSION["address"], ENT_QUOTES, 'UTF-8') ?>
		
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
				<label for=cardnumber>Kortnummer</label>
				<input id=cardnumber name=cardnumber type=number placeholder="1234123412341234" required /><br>
				
				<label for=expirationdate>Giltlighetstid</label>
				<input id=expirationmonth name=expirationmonth type=number placeholder="01" required />
				<input id=expirationyear name=expirationyear type=number placeholder="20" required /> <br>
				
				<label for=cvc>CVC</label>
				<input id=cvc name=cvc type=nummer placeholder="000" required /><br>
				
				<label for=cardname>Namn på kortet</label>
				<input id=cardname name=cardname placeholder="Sam Morris" required /> <br>
		</fieldset>
		<fieldset>
			<button type=submit>Betala</button>
			
			<!-- Generera kvittosida. -->
		</fieldset>
	</form>
	</section>

</body>
</html>