<ul class="list">
  <?php
   if(!isset($_SESSION['loggedIn']) || !$_SESSION["loggedIn"]):?>
      <li><a href=register.php>Registrera</a></li>
      <li><a href=login.php>Logga in</a></li>
      <li><a class="active" href=index.php>Hem</a></li>
  <?php elseif(isset($_SESSION['username'])): ?>
      <li><a href=logoutscript.php>Logga ut</a></li>
      <li><a href=orders.php>Beställningar</a></li>
      <li><a class="active" href=/>Hem</a></li>
      <li style=font-size:18px;float:left><a> <?="Logged in as: ".htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8')?></a></li>
  <?php endif;?>
</ul>
