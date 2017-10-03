<?php
session_start();
require_once 'csrf.php';
$currpage='login.php';
if(isset($_SESSION['username']))
  echo "<script> window.location = 'index'; </script>";
 ?>
<html>
  <head>
    <title> Login </title>
    <link rel="stylesheet" href="styles.css">
    <?php include 'navbar.php'
    ?>
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
        require 'connect.php';

        if(isset($_POST["username"]) && isset($_POST["password"]) && csrf_check($_POST['csrf'])){
          $authenticated = $db->authUser($_POST['username'],$_POST['password']);
          if($authenticated) {
            echo "Login was successful you will be redirected shortly";
            session_regenerate_id();
            $_SESSION["username"] = $_POST['username'];
            header("Location:index");
          } else
            echo "Invalid username or password";
        }
        ?>
    </div>
  </body>
</html>
