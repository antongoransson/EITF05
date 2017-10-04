<?php
session_start();
require realpath('../csrf.php');
require realpath('../connect.php');
echo $_POST["csrf"];
if(!isset($_SESSION['username']) || !isset($_SESSION["payed"]))// || !csrf_check($_GET["csrf"]))
  echo "<script>  window.location = '../';</script>";
	else {
	  $currpage = "receipt.php";
		include realpath('../navbar.php');
	  ?>
	  <html>
	  <head>
			<meta charset="utf-8">
	    <title>Receipt</title>
			<link rel=stylesheet href=receipt.css />
	  </head>
	  <body style=margin-left:0;>
	    <div class=invoice-box>
	      <table cellpadding="0" cellspacing="0">
	        <tr class="top">
	          <td colspan="3">
	            <table>
	              <tr>
	                <td class="title"></td>
	                <td></td>
	                <td></td>
	              </tr>
	            </table>
	          </td>
	        </tr>
	        <tr class="information">
	          <td colspan="3">
	            <table>
	              <tr>
	                <td>
	                  <?="<b>Namn:</b> ".htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8').'<br>'?>
	                  <?="<b>Address:</b> ".htmlspecialchars($db->getAddress($_SESSION['username']), ENT_QUOTES, 'UTF-8')?>
	                </td>
	                <td style=text-align:right;>
	                  Kvitto #: <?=rand(873,2381)?><br>
	                  Betald: <?= date('Y-m-d H:i')?><br></td>
	              </tr>
	            </table>
	          </td>
	        </tr>
	        <tr class="heading">
	          <td>Betalningssätt</td>
	          <td></td>
	          <td></td>
	        </tr>
	        <tr class="details">
	          <td>Kort</td>
	          <td></td>
	        </tr>
	        <tr class="heading">
	          <td>Vara</td>
	          <td>Antal</td>
	          <td>Pris</td>
	        </tr>
	        <?php
	          $total = 0;
	          $item_info = array();
	          $all_item_info = $db->getItems();
	          foreach($_SESSION["cart"] as $id => $amount) {
	            foreach($all_item_info as $item){
	              if ($item["itemid"] == $id) {
	                $item_info = $item;
	                break;
	              }
	            }
	          ?>
	          <tr class="item">
	            <td><?= $item_info["name"]; ?></td>
	            <td><?= $amount; ?></td>
	            <td><?= $item_info["price"]; ?> kr</td>
	          </tr>
	          <?php
	            $total+= ($amount * $item_info["price"]);
	            }
	          ?>
	        <tr class="total">
	          <td></td>
	          <td></td>
	          <td>Total: <?= $total." kr"?></td>
	        </tr>
	      </table>
	    </div>
	  </body>
	<?php
	  $db->putOrder($_SESSION['username'], $_SESSION['cart']);
	  unset($_SESSION["cart"]);
	 	unset($_SESSION["payed"]);
	}?>
	</html>
