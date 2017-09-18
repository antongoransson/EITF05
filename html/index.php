<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
  <title> Shop </title>
  <link rel="stylesheet" href="styles.css">
  <h1><?php if($_SESSION["loggedIn"]) echo "Användare: ". $_SESSION["username"]?></h1>
</head>
  <body>
    <h1>Shop</h1>
    <?php
    if(!$_SESSION["loggedIn"])
      echo '<a href="/login">Login</a>';
    else
      echo '<a href="/login/logoutscript.php">Logout</a>';
    ?>
    <?php if(!$_SESSION["loggedIn"]) echo '<a href="/register">Register</a>'?>
    <br><br>
    <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      require 'vendor/autoload.php';
      use SQL\SQLiteConnection;
      use SQL\db;

      $pdo = (new SQLiteConnection())->connect();
      if ($pdo != null){
        $db = new DB($pdo);
        if(!$db) {
          echo $db->lastErrorMsg();
        } else {
          $items= $db->getItems();
        }
      } else {
        echo "Could not connect to DB";
      }
      $pdo = null;
      $db = null;
    ?>
  </body>
    <?php if (count($items) > 0): ?>
      <!-- <div><?php echo implode('</div><div>', array_keys(current($items))); ?></div> -->
      <?php foreach ($items as $row): array_map('htmlentities', $row); ?>
        <div class="shopitem">
          <?php echo '<img src="images/'.$row["name"].'.jpg" alt=Smiley face height= 100 width= 150 align= left vspace= 50px/>'; ?>
          <h1><?php echo($row['name']); ?></h1>
          <div class="form">
            <h2><?php echo("Pris: ".$row['price']." kr"); ?></h2>
            <form class="item" method="post" >
              <select>
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
                <option value=6>6</option>
                <option value=7>7</option>
                <option value=8>8</option>
                <option value=9>9</option>
                <option value=10>10</option>
              </select>
              <input type="submit" value= "Lägg till i kundvagn"/>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
  <?php endif; ?>
</html>
