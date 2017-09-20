<?php
  session_start();
  require 'connect.php';
  $items=array(1=>4,2=>2,3=>7);
  // $db->putOrder($_SESSION['username'], $items);
  $items = $db->getOrder($_SESSION['username']);
?>

<html>
<head>
  <link rel="stylesheet" href="/../styles.css">
  <?php include 'navbar.php'
  ?>
</head>

<h1>Orders</h1>
<?php if (count($items) > 0):
   echo "<table><tr><th>OrderId</th><th>ItemId</th><th>Nbr</th></tr>";
   ?>
  <?php foreach ($items as $row){
    echo "<tr><td>".$row["orderid"]."</td><td>".$row["itemid"]."</td><td>".$row["nbrofitems"]."</td></tr>";
  }
  echo "</table>";
  ?>
<?php endif; ?>
</html
