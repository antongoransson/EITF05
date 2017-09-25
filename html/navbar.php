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
        background-color: #4CAF50;
    }
  </style>

<ul class="list">
  <?php
   if(!isset($_SESSION['loggedIn']) || !$_SESSION["loggedIn"]):?>
    <li><a href=register.php>Registrera</a></li>
    <li><a href=login.php>Logga in</a></li>
    <li><a href="checkout.php">Kundvagn</a></li>
    <li><a class="active" href=index.php>Hem</a></li>
  <?php elseif(isset($_SESSION['username'])): ?>
    <li><a href=logoutscript.php>Logga ut</a></li>
    <li><a href=orders.php>Beställningar</a></li>
    <li><a href="checkout.php">Kundvagn</a></li>
    <li><a class="active" href=/>Hem</a></li>
    <li style=font-size:18px;float:left><a> <?="Inloggad som: ".htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8')?></a></li>
  <?php endif;?>
</ul>
