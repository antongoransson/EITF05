<?php
session_start();
require_once 'csrf.php';
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
  echo "<script> window.location = 'index.php'; </script>";
$currpage = "register.php";
include 'navbar.php';
 ?>
<html>
	<head>
		<title>Registrering</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
			<form class="login" method="post" >
        <div class="login" >
  				<label><b>Username</b></label>
          <input type="text" name="username" required><br>
  				<label><b>Password</b></label>
          <input type="password" name="password" required><br>
  				<label><b>Address</b></label>
          <input type="text" name="address" required><br>
					<?php echo csrf_input_tag(); ?>
  				<button type="submit">Register</button>
			<div style="background-color:#f1f1f1">
				<button class=cancelbtn type=button onclick="history.back()">Cancel</button>
			</div>
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
    if(isset($_POST['username']) && csrf_check($_POST['csrf'])){
  		if ($_POST['username'] !='' && $_POST['password'] !='' && $_POST['address'] !='') {
  			$minpasslength = 7;
  			if (strlen($_POST['password']) < $minpasslength || strlen($_POST['password']) >=160 ){
  				$error = "Password must be at least ".$minpasslength." characters long.";
  			} elseif (in_array($_POST['password'], $blacklist)){
  				$error = "The password is too weak.";
  			} elseif ($_POST['password'] == $_POST['username']) {
  				$error = "Your password can't be your username.";
  			} elseif (!(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['password']))){
				$error = "Password must contain letters and numbers.";
			}else {
  				$hashedpw = password_hash( $_POST['password'], PASSWORD_DEFAULT);
  				$registered = $db->addUser($_POST['username'], $hashedpw, $_POST['address']);
  				if($registered){
            session_regenerate_id();
            $_SESSION["loggedIn"]=true;
            $_SESSION['username'] = $_POST['username'];
  					echo "<script> window.location = 'index.php'; </script>";
  				} else {
  					$error = "Username already in use";
  				}
  			}
        echo $error;
  		}
    }
		?>
		</div>
	</body>
</html>
