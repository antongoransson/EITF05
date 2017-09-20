<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
?>
<html>
  <head>
    <title> Login </title>
    <link rel="stylesheet" href="/../styles.css">
  </head>
  <body>
    <div class="login"align="center">
      <form class="login" method="post" >
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login" >
      </form>
      <form>
        <input type="submit"onclick="history.back()" value="Go Back" />
      </form>
      <?php
        require realpath(dirname(__DIR__).'/connect.php');

        if(isset($_POST["username"]) && isset($_POST["password"])){
          $authenticated = $db->authUser($_POST['username'],$_POST['password']);
          if($authenticated) {
            echo "Login was successful you will be redirected shortly";
            $_SESSION["loggedIn"] = true;
            $_SESSION["username"] = $_POST['username'];
            header("Location:http://localhost/");
          } else
            echo "Invalid username or password";
        }
        ?>
    </div>
  </body>
</html>
