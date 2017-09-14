<html>
  <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require(__DIR__ . '/db.php');
    $db = new DB();
    $authenticated = $db->authUser($_POST['username'],$_POST['password']);
    if($authenticated) {
      echo "Login was successful";
    } else
      echo "Invalid username or password";
  ?>
  <?php if ($authenticated): ?>
    <meta http-equiv="refresh" content="1; URL=/">
    <meta name="keywords" content="automatic redirection">
  <?php else: ?>
    <form action="/">
      <input type="submit" value="Go Back" />
    </form>
  <?php endif; ?>
</html>
