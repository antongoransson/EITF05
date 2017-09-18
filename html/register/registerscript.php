<html>
  <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require realpath(dirname(__DIR__).'/vendor/autoload.php');
    use App\SQLiteConnection;
    use App\db;

    $pdo = (new SQLiteConnection())->connect();
    if ($pdo != null){
      $db = new DB($pdo);
      $hashedpw = password_hash( $_POST['password'], PASSWORD_DEFAULT);
      $registered = $db->addUser($_POST['username'], $hashedpw, $_POST['address']);
      if($registered)
        echo "Registration was successful";
       else
        echo "Username already in use";
    }
    $pdo = null;
    $db = null;
  ?>
  <?php if ($registered): ?>
    <meta http-equiv="refresh" content="1; URL=/">
    <meta name="keywords" content="automatic redirection">
  <?php else: ?>
    <meta http-equiv="refresh" content="0; URL=/register">
    <meta name="keywords" content="automatic redirection">
    <form action="/">
      <input type="submit" value="Go Back" />
    </form>
  <?php endif; ?>
</html>
