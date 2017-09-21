<?php
  session_start();
  require 'connect.php';
  $items=array(1=>4,2=>2,3=>7);
  // $db->putOrder($_SESSION['username'], $items);
  $items = $db->getOrders($_SESSION['username']);
?>

<html>
<head>
  <link rel="stylesheet" href="/../styles.css">
  <?php include 'navbar.php'
  ?>
</head>
<h1>Orders</h1>
<?php if (count($items) > 0):
   echo "<table><tr><th>OrderId</th><th>ItemId</th>
   <th>Amount</th><th>Time</th><th>Kostnad</th></tr>";
   ?>
  <?php
  function printCostRow($price, $row){
    echo "<tr><td>Total Kostnad: ".$price. "</td><td></td><td></td><td></td><td></td></tr>";
  }
  
  $first = true;
  $price = 0;
  $ctr = 0;
  foreach ($items as $row) {
    if($first){
      $orderid = $row["orderid"];
      $first = false;
    }
    if($orderid != $row["orderid"]){
      printCostRow($price, $row);
      $price = 0;
      $orderid = $row["orderid"];
    }
    $ctr++;
    $price += $db->getItemPrice($row["itemid"])*$row["nbrofitems"];
    echo "<tr><td>".$row["orderid"]."</td><td>".$db->getItemName($row["itemid"])."</td>
    <td>".$row["nbrofitems"]."</td><td>".$row["timedate"]."</td>
    <td>".$db->getItemPrice($row["itemid"])*$row["nbrofitems"]."</td></tr>";
    if($ctr == count($items)){
      printCostRow($price, $row);
      $price = 0;
      $orderid = $row["orderid"];
    }
  }
  echo "</table>";
  ?>

<?php endif; ?>
</html
