<?php
session_start();
require_once 'csrf.php';
require_once 'connect.php';
?>
<html>
<head>
  <title> Shop </title>
  <link rel="stylesheet" href="styles.css">
  <?php include 'navbar.php';?>
</head>
  <body>
    <h1 class="title">Shop</h1>
    <?php
      if(!$db)
        echo $db->lastErrorMsg();
       else
        $items= $db->getItems();

      if(isset($_POST["nbrOfItems"]) && $_POST["nbrOfItems"] > 0 && csrf_check($_POST['csrf'])){
       	$_SESSION["cart"][$_POST["itemid"]] += $_POST["nbrOfItems"];
        $_POST["nbrOfItems"] = 0;
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
          <form class="item" <?php echo $row["itemid"]; ?> method="post">
            <h2>Pris <?=$row['price']?> kr</h2>
		        <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>">
  			    <select name=nbrOfItems>
              <?php for ($i = 1; $i <= 10; $i++) { ?>
                <option value=<?= $i ?>><?= $i ?></option>
              <?php } ?>
            </select>
            <?php
            echo '<input type=hidden name= itemid value='.$row["itemid"].'>';
            echo csrf_input_tag();
            ?>
            <input type="submit" name="add" class="btn btn-default" value="Lägg till i kundvagn">
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</html>
