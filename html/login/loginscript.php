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
    $authenticated = $db->authUser($_POST['username'],$_POST['password']);
    if($authenticated) {
      echo "Login was successful";
    } else
      echo "Invalid username or password";
    }
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
