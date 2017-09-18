<?php
session_start();
?>
<html>
  <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require realpath(dirname(__DIR__).'/vendor/autoload.php');
    use App\SQLiteConnection;
    use App\db;
    $_SESSION["loggedIn"] = false;
  ?>
    <meta http-equiv="refresh" content="1; URL=/">
    <meta name="keywords" content="automatic redirection">
    <body>
      Logout was successful you should be redirected to main page soon
      Press <a href="/">HERE</a> to go there manually.
    </body>
</html>
