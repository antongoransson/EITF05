<?php
session_start();
include 'connect.php';
if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'])
  echo "<script> window.location = 'index.php'; </script>";
$currpage = "receipt.php";
include 'navbar.php'
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Receipt</title>
  <style>
    .invoice-box {
      max-width:800px;
      margin:auto;
      margin-top: 100px;
      padding:30px;
      border:1px solid #eee;
      box-shadow:0 0 10px rgba(0, 0, 0, .15);
      font-size:16px;
      line-height:24px;
      font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      color:#555;
    }
    .invoice-box table{
      width:100%;
      line-height:inherit;
      text-align:left;
    }

    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }

    .invoice-box table tr td:nth-child(3){
        text-align:right;
    }

    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }

    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }

    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }

    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }

    .invoice-box table tr.details td{
        padding-bottom:20px;
    }

    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }

    .invoice-box table tr.item.last td{
        border-bottom:none;
    }

    .invoice-box table tr.total td:nth-child(3){
        border-top:2px solid #eee;
        font-weight:bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }

      .invoice-box table tr.information table td{
          width:100%;
          display:block;
          text-align:center;
      }
    }

  </style>
</head>
<body style=margin-left:0;>
  <div class="invoice-box">
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
                <?="<b>Namn:</b> ".$_SESSION['username'].'<br>'?>
                <?="<b>Address:</b> ".$db->getAddress($_SESSION['username'])?>
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
unset($_SESSION["cart"]);?>
</html>
