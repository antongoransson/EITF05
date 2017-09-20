<?php
namespace SQL;


class DB {
  private $pdo;

/**
* connect to the MySQL database
*/
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  function getItems() {
    $response = $this->pdo->query('SELECT * FROM Items');
    $items = array();
    while($row = $response->fetch(\PDO::FETCH_ASSOC)) {
      $items[]=$row;
    }
    return $items;
  }
  function putOrder($username, $itemid) {
    $statement = $this->pdo->prepare("INSERT INTO Orders(orderid, itemid, username, nbrofitems)
    VALUES(:orderid, :itemid, :username, :nbrofitems)");
  }

  function addUser($username, $pwhash, $address) {
    $userStatement = $this->pdo->prepare("SELECT * FROM Users WHERE username=:username;");
    $userStatement->bindValue(':username', $username);
    $response = $userStatement->execute();
    if($response) {
      $statement = $this->pdo->prepare("INSERT INTO Users(username, pwhash, address)
      VALUES(:username,:pwhash,:address)");
      $ret = $statement->execute(array(
        ':username' => $username,
        ':pwhash' => $pwhash,
        ':address' => $address
      ));
      if(!$ret) {
        echo "\nPDO::errorInfo():\n";
        print_r($statement->errorInfo());
        return false;
      } else {
        return true;
      }
    } else {
      return false;
    }
  }

  function authUser($username, $password) {
    $statement = $this->pdo->prepare("SELECT * FROM Users WHERE username=:username;");
    $statement->bindValue(':username', $username);
    $response = $statement->execute();
    if($response) {
    $user = $statement->fetch(\PDO::FETCH_ASSOC);
      if(is_array($user)){
        if($user['username'] == $username && password_verify($password, $user['pwhash']))
          return true;
      }
      return false;
    }
  }
 }
?>
