<?php
session_start();
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
  echo "<script> window.location = 'index.php'; </script>";
include 'navbar.php';
 ?>
<html>
	<head>
		<title>Registrering</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<div class="login"align="center">
			<form class="login" method="post" >
				<label>Username:</label><input type="text" name="username"><br>
				<label>Password:</label><input type="password" name="password"><br>
				<label>Address:</label><input type="text" name="address"><br>
				<input type="submit" value= "Register" >
			</form>
			<form >
				<input type="submit" onclick="history.back()" value="Go Back" />
			</form>
		<?php
		require 'connect.php';
		$blacklist = array(
			"password", "12345678", "123456789", "football",
			"1234567890", "1qaz2wsx", "princess", "qwertyuiop",
			"passw0rd", "starwars", "baseball", "jennifer",
			"superman", "trustno1", "michelle", "sunshine",
			"computer", "corvette", "iloveyou", "maverick"
		);
		if ($_POST['username'] !='' && $_POST['password'] !='' && $_POST['address'] !='') {
			$minpasslength = 7;
			if (strlen($_POST['password']) < $minpasslength || strlen($_POST['password']) >=160 ){
				echo "Password must be at least ".$minpasslength." characters long.";
			} elseif (in_array($_POST['password'], $blacklist)){
				echo "The password is too weak.";
			} elseif ($_POST['password'] == $_POST['username']) {
				echo "Your password can't be your username.";
			} else {
				$hashedpw = password_hash( $_POST['password'], PASSWORD_DEFAULT);
				$registered = $db->addUser($_POST['username'], $hashedpw, $_POST['address']);
				if($registered){
          session_regenerate_id();
          $_SESSION["loggedIn"]=true;
          $_SESSION['username'] = $_POST['username'];
					echo "<script> window.location = 'index.php'; </script>";
				} else {
					echo "Username already in use";
				}
			}
		}
		?>
		</div>
	</body>
</html>
