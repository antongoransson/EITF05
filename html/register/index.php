<?php
	session_start();
	require_once realpath('../csrf.php');
	if(isset($_SESSION['username']))
	  echo "<script> window.location = '../'; </script>";
	$currpage = "register.php";
	include realpath('../navbar.php');
?>
<html>
	<head>
		<title>Registrering</title>
		<link rel="stylesheet" href=../css/index.css?/>
	</head>
	<body>
			<form class="login" method="post" >
        <div class="login" >
  				<label><b>Username</b></label>
          <input type="text" name="username" maxlength=50 required><br>
  				<label><b>Password</b></label>
          <input type="password" name="password" maxlength=159 required><br>
  				<label><b>Address</b></label>
          <input type="text" name="address" maxlength=50 required><br>
					<?php echo csrf_input_tag(); ?>
  				<button type="submit">Register</button>
			<div style="background-color:#f1f1f1">
				<button class=cancelbtn type=button onclick="history.back()">Cancel</button>
			</div>
    </form>
		<?php
		require realpath('../connect.php');
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
				} elseif (strlen($_POST['username']) > 50) {
					$error = "Nice try, but we also check username length serverside.";
				} elseif (strlen($_POST['address']) > 50) {
					$error = "Nice try, but we also check address length serverside.";
				} else {
						$hashedpw = password_hash( $_POST['password'], PASSWORD_DEFAULT);
						$registered = $db->addUser($_POST['username'], $hashedpw, $_POST['address']);
						if($registered){
							session_regenerate_id();
							$_SESSION["loggedIn"]=true;
							$_SESSION['username'] = $_POST['username'];
							echo "<script> window.location = '../'; </script>";
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
