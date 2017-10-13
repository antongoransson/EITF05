<?php
session_start();
require_once realpath('../csrf.php');
$currpage='login.php';
include realpath('../navbar.php');
if(isset($_SESSION['username']))
  echo "<script> window.location = '../'; </script>";
require realpath('../connect.php');
 ?>
<html>
  <head>
    <title> Login </title>
		<link rel="stylesheet" type=text/css href="../css/index.css">
  </head>
  <body>
      <form class="login" method="post" >
        <div class="login">
          <label><b>Username</b></label>
          <input type="text" name="username" required><br>
          <label><b>Password</b></label>
          <input type="password" name="password" required><br>
					<?php echo csrf_input_tag();?>
          <button type="submit" >Login</button>
        <div style="background-color:#f1f1f1">
          <button class="cancelbtn" type="button"  onclick="history.back()" >Cancel</button>
        </div>
      </form>
      <?php
        if(isset($_POST["username"]) && isset($_POST["password"]) && csrf_check($_POST['csrf'])){
          list($authenticated, $username) = $db->authUser($_POST['username'],$_POST['password']);
          if($authenticated) {
            echo "Login was successful you will be redirected shortly";
            session_regenerate_id();
            $_SESSION["username"] = $_POST['username'];
            header("Location:/");
          } else
            echo "Invalid username or password";
        }
        ?>
    </div>
  </body>
</html>
