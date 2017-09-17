<!DOCTYPE html>
<html>
<head>
  <title> Shop </title>
  <link rel="stylesheet" href="styles.css">
</head>
  <body>
    <h1>Shop</h1>
    <a href="/login">Login</a>
    <a href="/register">Register</a>
    <br><br>
    <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      require 'vendor/autoload.php';
      use App\SQLiteConnection;
      use App\db;

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
    ?>
  </body>
    <?php if (count($items) > 0): ?>
      <!-- <div><?php echo implode('</div><div>', array_keys(current($items))); ?></div> -->
      <?php foreach ($items as $row): array_map('htmlentities', $row); ?>
        <div class="shopitem">
          <!-- <?php echo $row['name']."Pris: ". $row['price']; ?> -->
          <?php echo '<img src="images/'.$row["name"].'.jpg" alt=Smiley face height= 100 width= 150 align= left vspace= 50px/>'; ?>
          <h1><?php echo($row['name']); ?></h1>
          <div class="form">
            <h2><?php echo("Pris: ".$row['price']); ?></h2>
            <form class="item" method="post" action="">
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
              <input type="submit" value= "Add to cart"/>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
  <?php endif; ?>
</html>
