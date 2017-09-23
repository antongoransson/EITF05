<ul class="list">
<?php
 if(!isset($_SESSION['loggedIn']) || !$_SESSION["loggedIn"]):?>
    <li><a href=register.php>Register</a></li>
    <li><a href=login.php>Login</a></li>
    <li><a class="active" href=index.php>Home</a></li>
<?php elseif(isset($_SESSION['username'])): ?>
    <li><a href=login/logoutscript.php>Logout</a></li>
    <li><a href=orders.php>Orders</a></li>
    <li><a class="active" href=/>Home</a></li>
    <li style=font-size:18px;float:left><a> <?="Logged in as: ".htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8')?></a></li>
<?php endif;?>

</ul>
