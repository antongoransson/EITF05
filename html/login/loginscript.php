<?php
session_start();
?>
<html>
  <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require realpath(dirname(__DIR__).'/vendor/autoload.php');
    use SQL\SQLiteConnection;
    use SQL\db;
    $pdo = (new SQLiteConnection())->connect();
    if ($pdo != null){
      $db = new DB($pdo);
      $authenticated = $db->authUser($_POST['username'],$_POST['password']);
      if ($authenticated) {
        echo "Login was successful";
        $_SESSION["loggedIn"] = true;
        $_SESSION["username"] = $_POST['username'];
      } else
        echo "Invalid username or password";
    }
    $pdo = null;
    $db = null;
  ?>
  <?php if ($authenticated): ?>
    <meta http-equiv="refresh" content="1; URL=/">
    <meta name="keywords" content="automatic redirection">
  <?php else: ?>
    <meta http-equiv="refresh" content="0; URL=/login">
    <meta name="keywords" content="automatic redirection">
  <?php endif; ?>
</html>
