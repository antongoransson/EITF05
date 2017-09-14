<html>
  <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require(__DIR__ . '/db.php');
    $db = new DB();
    $hashedpw = password_hash( $_POST['password'], PASSWORD_DEFAULT);
    $registered = $db->addUser($_POST['username'], $hashedpw, $_POST['address']);
    if($registered) {
      echo "Registration was successful";
    } else
      echo "Username already in use";
  ?>
  <?php if ($registered): ?>
    <meta http-equiv="refresh" content="1; URL=/">
    <meta name="keywords" content="automatic redirection">
  <?php else: ?>
    <form action="/">
      <input type="submit" value="Go Back" />
    </form>
  <?php endif; ?>
</html>
