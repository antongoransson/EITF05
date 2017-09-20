<?php
session_start();
require 'connect.php';
?>
<html>
<head>
  <title> Shop </title>
  <link rel="stylesheet" href="/styles.css">
  <?php include 'navbar.php';
  ?>
</head>
  <body>
    <h1>Shop</h1>

    <br><br>
    <?php
      if(!$db)
        echo $db->lastErrorMsg();
       else
        $items= $db->getItems();

      if(isset($_POST["nbrOfItems"] )){
         echo $_POST["itemid"];
      }
    ?>


  </body>
    <?php if (count($items) > 0): ?>
      <?php foreach ($items as $row):?>
        <div class="shopitem">
          <img src="images/<?=$row["name"]?>.jpg" alt="INSERT PIC HERE"
           height= 100 width= 150 align= left vspace= 50px/>
          <h1><?= $row['name'] ?></h1>
          <div class="form">
            <h2>Antal <?=$row['price']?> kr</h2>
            <form class="item" method="post">
              <select name=nbrOfItems>
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                  <option value=<?= $i ?>><?= $i ?></option>
                <?php } ?>
              </select>
              <?php
              echo '<input type=hidden name= itemid value='.$row["itemid"].'>';
              ?>
              <input type="submit"value="Lägg till i kundvagn"/>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
  <?php endif; ?>
</html>
