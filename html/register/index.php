<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="/../styles.css">
  </head>
  <body>
    <div class="login"align="center">
      <form class="login" method="post" >
        Username:<input type="text" name="username"><br>
        Password:<input type="password" name="password"><br>
        Address: <input type="text" name="address"><br>
        <input type="submit" value= "Register" >
      </form>
      <form action="/">
        <input type="submit" value="Go Back" />
      </form>
      <?php
        require realpath(dirname(__DIR__).'/connect.php');
		
		$blacklist = array("password", "12345678", "123456789", "football", "1234567890", "1qaz2wsx", "princess", "qwertyuiop", "passw0rd", "starwars", "baseball", "jennifer", "superman", "trustno1", "michelle", "sunshine", "computer", "corvette", "iloveyou", "maverick");
		
		if(strlen($_POST['password'])<= 7 || strlen($_POST['password']) >=160 ){
			echo "Incorrect passwod length.";
		}
		
		elseif(in_array($_POST['password'], $blacklist)){
			echo "The password is too weak.";
		}

        elseif($_POST['username'] !='' && $_POST['password'] !='' && $_POST['address'] !='') {
          $hashedpw = password_hash( $_POST['password'], PASSWORD_DEFAULT);
          $registered = $db->addUser($_POST['username'], $hashedpw, $_POST['address']);
          if($registered){
            echo "Registration was successful you will be redirected to home page";
            header("refresh:2;URL=http://localhost/");
          } else{
             echo "Username already in use";
         }
       }
      ?>
    </div>
  </body>


</html>
