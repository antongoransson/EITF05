<style>
  ul.list {
      list-style-type: none;
      position: fixed;
      width: 100%;
      top:0;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
      padding-left: 8px;
    }

    li {
        float: right;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    /* Change the link color to #111 (black) on hover */
    li a:hover:not(.active) {
        background-color: #111;
    }

    .active {
        background-color: #3399ff;
    }
  </style>
<ul class="list">
  <?php
   if(!isset($_SESSION['loggedIn']) || !$_SESSION["loggedIn"]):?>
    <li><a <?= getActive($currpage,"register.php")?> href=register.php>Registrera</a></li>
    <li><a <?= getActive($currpage,"login.php")?> href=login.php>Logga in</a></li>
    <li><a <?= getActive($currpage,"checkout.php")?> href="checkout.php">Kundvagn</a></li>
    <li><a <?= getActive($currpage,"index.php")?> href=index.php>Shop</a></li>
  <?php elseif(isset($_SESSION['username'])): ?>
    <li><a href=logoutscript.php>Logga ut</a></li>
    <li><a <?= getActive($currpage,"orders.php")?> href=orders.php>Beställningar</a></li>
    <li><a <?= getActive($currpage,"checkout.php")?> href="checkout.php">Kundvagn</a></li>
    <li><a <?= getActive($currpage,"index.php")?> href=/>Shop</a></li>
    <li style=background-color:#ff66cc;color:black;font-size:18px;float:left><a style=color:black> <?="Inloggad som:<b> ".htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8').'</b>'?></a></li>
  <?php endif;
    function getActive($currpage, $page){
       if ($currpage == $page)
        return "class = active";
    }
  ?>
</ul>
