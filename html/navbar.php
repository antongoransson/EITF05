<head>
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
   z-index: 2;
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
	 .loginname, .title {
	   float:left;
	 }
	 p {
	   background-color:#ff66cc;
	   color:black;
	   font-size:23px;
	   padding: 10px 12px;
	   margin:0;
	 }
	  h4 {
		  color:#ccc;
			font-size:23px;
	 		margin:0;
	 		padding: 10px 12px;
	  }
</style>
</head>
<ul class="list">
  <?php
   if(!isset($_SESSION['username'])):?>
    <li><a <?= getActive($currpage,"register.php")?> href=/register>Registrera</a></li>
    <li><a <?= getActive($currpage,"login.php")?> href=/login>Logga in</a></li>
    <li><a <?= getActive($currpage,"checkout.php")?> href="/checkout">Kundvagn</a></li>
		<li><a <?= getActive($currpage,"reviews.php")?> href=/reviews>Recensioner</a></li>
    <li><a <?= getActive($currpage,"index.php")?> href=/>Shop</a></li>
  <?php elseif(isset($_SESSION['username'])): ?>
    <li><a href=/logout>Logga ut</a></li>
    <li><a <?= getActive($currpage,"orders.php")?> href=/orders>Beställningar</a></li>
    <li><a <?= getActive($currpage,"checkout.php")?> href="/checkout">Kundvagn</a></li>
		<li><a <?= getActive($currpage,"reviews.php")?> href=/reviews>Recensioner</a></li>
    <li><a <?= getActive($currpage,"index.php")?> href=/>Shop</a></li>
    <li class=loginname>
      <p>
        <?="Inloggad som:<b> ".htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8').'</b>'?>
      </p>
    </li>
  <?php endif;
    function getActive($currpage, $page){
       if ($currpage == $page)
        return "class = active";
    }
  ?>
		<li class=title>
			<h4>
				Noneuclidian Store - <i>Your one stop shop for abstract concepts!</i>
			</h4>
		</li>
</ul>
