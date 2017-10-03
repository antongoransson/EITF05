<?php
  session_start();
  require 'connect.php';
	require 'csrf.php';
  $currpage = "reviews.php";
	include 'navbar.php';
  $reviews = $db->getReviews();
?>

<html>
  <head>
    <title>Recensioner</title>
    <link rel="stylesheet" href="styles.css">
    <?php

		if(isset($_POST["subject"]) && csrf_check($_POST['csrf'])){
			$db->putReview($_SESSION["username"], $_POST["subject"], $_POST["comment"]);
			unset($_POST["subject"]);
			echo "<meta http-equiv='refresh' content='0'>";
		}
    ?>
  </head>
	<style>

/* Add a background color and some padding around the form */
	.container {
	    border-radius: 5px;
	    background-color: #f2f2f2;
	    padding: 20px;
			width:50%;
			margin-left:100px;
			margin-top: 20px;
	}
</style>
  <div style=margin-top:60px;>
    <?php if (count($reviews) > 0) :
			foreach($reviews as $row){
				echo "
				<div style=display:block;>
					<img src=/images/placeholder.jpg width = 80/>
					<div class=review>
					<span class = tip></span>
						<div class=reviewheader>
							<h1 class=review>".htmlspecialchars($row["subject"], ENT_QUOTES, 'UTF-8')."</h1>
							<span style=float:right;>Datum: <b>".$row["timedate"]."</b> \n
							<br> Commenter:<b>"
								.htmlspecialchars($row["username"], ENT_QUOTES, 'UTF-8')."</b></span>
						</div>
						<div style=padding:25px;background-color:#d9d9d9>
							<span class=comment>
								". htmlspecialchars($row["comment"], ENT_QUOTES, 'UTF-8') .
							"</span>
						</div>
					</div>
				</div>";
			}
    ?>
  </div>
  <?php else:
    echo "<h1>Det finns inga recensioner, bli den första som skriver en!</h1>";
   ?>
  <?php endif; ?>
	<?php if(isset($_SESSION["username"])):?>
	<div class="container">
  <form method="post">
    <label for="subject">Subject</label>
    <input type="text" id=subject name="subject" placeholder="Subject">
    <label for="subject">Comment</label>
    <textarea class=review id="subject" name="comment" placeholder="Write something.." style="height:200px"></textarea>
		<?= csrf_input_tag()?>
    <button type=submit>Submit</button>

  </form>
<?php else:?>
	<h1>Log in to add a review</h1>
<?php endif; ?>
</div>
</html
