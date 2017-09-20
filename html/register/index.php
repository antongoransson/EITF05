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
      <form >
        <input type="submit" onclick="history.back()" value="Go Back" />
      </form>
      <?php
        require realpath(dirname(__DIR__).'/connect.php');

        if($_POST['username'] != '' && $_POST['password'] != '' && $_POST['address'] != '') {
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
