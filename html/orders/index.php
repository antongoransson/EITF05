<?php
  session_start();

	require realpath('../connect.php');
  if(!isset($_SESSION['username']))
    echo "<script> window.location = '../'; </script>";
  $currpage = "orders.php";
	include realpath('../navbar.php');
  $items = $db->getOrders($_SESSION['username']);
?>

<html>
  <head>
    <title>Beställningar</title>
    <link rel="stylesheet" href="../css/index.css">
  </head>
  <div style=margin-top:60px;overflow-y:scroll;height:90%;>
    <?php if (count($items) > 0):
       echo "<table><tr><th>Vara</th><th>Kund</th>
       <th>Antal</th><th>Tidpunkt</th><th>Kostnad</th></tr>";

      function printCostRow($price, $row){
        echo "<tr><td><b>Total Kostnad: ".$price. "</b></td><td></td><td></td><td></td><td></td></tr>";
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
        echo "<tr><td>".$db->getItemName($row["itemid"])."</td>
				<td>".htmlspecialchars($row["username"], ENT_QUOTES, 'UTF-8')."</td>
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
  </div>
  <?php else:
    echo "<h1>Du har inte handlat några varor! =)</h1>";
   ?>
  <?php endif; ?>
</html
