<html>
  <?php
    class DB extends SQLite3 {
      function __construct() {
         $this->open('db.db');
      }

      function getItems() {
        $response = $this->query('SELECT * FROM Items');
        $items = array();
        while($row = $response->fetchArray(SQLITE3_ASSOC)) {
              $items[]=$row;
        }
        return $items;
      }

      function addUser($username, $pwhash, $address) {
        $userStatement = $this->prepare("SELECT * FROM Users WHERE username=:username;");
        $userStatement->bindValue(':username', $username, SQLITE3_TEXT);
        $response = $userStatement->execute();
        if(!$response->fetchArray()) {
          $statement = $this->prepare("INSERT INTO Users(username, pwhash, address)
          VALUES(:username,:pwhash,:address)");
          $statement->bindValue(':username', $username, SQLITE3_TEXT);
          $statement->bindValue(':pwhash', $pwhash, SQLITE3_TEXT);
          $statement->bindValue(':address', $address, SQLITE3_TEXT);
          $ret = $statement->execute();
          if(!$ret) {
             echo $this->lastErrorMsg();
          } else {
            return true;
          }
        } else {
          return false;
        }
      }

      function authUser($username, $password) {
        $statement = $this->prepare("SELECT * FROM Users WHERE username=:username;");
        $statement->bindValue(':username', $username, SQLITE3_TEXT);
        if($statement) {
          $response = $statement->execute();
          $user = $response->fetchArray();
          if($user['username'] == $username && password_verify($password, $user['pwhash']))
            return true;
          return false;
        }
      }
     }
  ?>
</html>
