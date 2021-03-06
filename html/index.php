<?php
	session_start();
	require_once 'csrf.php';
	require_once 'connect.php';
	$currpage = "index.php";
	include 'navbar.php';
?>
<html>
<head>
  <title> Shop </title>
  <link rel="stylesheet" href="css/index.css"/>
</head>
  <body style=margin-top:70px;>
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

  <?php if (count($items) > 0): ?>
    <?php foreach ($items as $row):?>
      <div class="shopitem">
        <img src="images/<?=$row["name"]?>.jpg" alt="INSERT PIC HERE"
         height= 150 width= 200 align= left vspace= 25px style=margin-left:7px;/>
        <div class="form">
					<h1><?=$row['name']?></h1>
          <form class="item" <?= $row["itemid"]; ?> method="post">
            <h2>Pris: <?=$row['price']?> kr</h2>
  			    <select name=nbrOfItems>
              <?php for ($i = 1; $i <= 10; $i++) { ?>
                <option value=<?= $i ?>><?= $i ?></option>
              <?php } ?>
            </select>
            <?php
            echo '<input type=hidden name= itemid value='.$row["itemid"].'>';
            echo csrf_input_tag();
            ?>
            <button type="add" name="add">Lägg till i kundvagn</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
  </body>
</html>
