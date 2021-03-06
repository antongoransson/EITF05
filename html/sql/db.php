<?php

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

  function putOrder($username, $items) {
    $statement = $this->pdo->prepare("INSERT INTO Orders(orderid, itemid, username, timedate, nbrofitems)
    VALUES(:orderid, :itemid, :username, :timedate, :nbrofitems)");
    $sql = "SELECT orderid FROM Orders ORDER BY ID DESC LIMIT 1";
    $result = $this->pdo->query($sql);
    $currorderId = $result->fetch()['orderid'];
    if(count($items) > 0){
      $orderid= $currorderId + 1;
      $date = date('Y-m-d H:i:s');
      foreach($items as $itemid => $nbrofitems) {
        if($nbrofitems > 0){
          $statement->bindValue(':timedate', $date, \PDO::PARAM_STR);
          $statement->bindValue(':orderid',$orderid, \PDO::PARAM_INT);
          $statement->bindValue(':itemid', $itemid, \PDO::PARAM_INT);
          $statement->bindValue(':nbrofitems', $nbrofitems, \PDO::PARAM_INT);
          $statement->bindValue(':username', $username, \PDO::PARAM_STR);
          $ret = $statement->execute();
          if(!$ret)
            print_r($statement->errorInfo());
          else{
          }
        }
      }
    }
  }

  function getOrders($username) {
		$items = array();
    $statement = $this->pdo->prepare("SELECT * from Orders WHERE username=:username");
    $statement->bindValue(':username', $username, \PDO::PARAM_STR);
    $ret = $statement->execute();
    while($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
      $items[]=$row;
    }
    return $items;
  }

  function getAddress($username) {
    $statement = $this->pdo->prepare("SELECT address from Users WHERE username=:username");
    $statement->bindValue(':username', $username, \PDO::PARAM_STR);
    $ret = $statement->execute();
    return $statement->fetch()[0];
  }

  function getItemName($itemid) {
    $statement = $this->pdo->prepare("SELECT name from Items WHERE itemid=:itemid");
    $statement->bindValue(':itemid', $itemid, \PDO::PARAM_INT);
    $ret = $statement->execute();
    return $statement->fetch()[0];
  }
  function getItemPrice($itemid) {
    $statement = $this->pdo->prepare("SELECT price from Items WHERE itemid=:itemid");
    $statement->bindValue(':itemid', $itemid, \PDO::PARAM_INT);
    $ret = $statement->execute();
    return $statement->fetch()[0];
  }

  function addUser($username, $pwhash, $address) {
    $userStatement = $this->pdo->prepare("SELECT * FROM Users WHERE username=:username;");
    $username =  htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $pwhash = htmlspecialchars($pwhash, ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars($address, ENT_QUOTES, 'UTF-8');
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
        return false;
      } else {
        return array(true, $username);
      }
    } else {
      return false;
    }
  }

  function authUser($username, $password) {
    $statement = $this->pdo->prepare("SELECT * FROM Users WHERE username=:username;");
    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $statement->bindValue(':username', $username);
    $response = $statement->execute();
    if($response) {
    	$user = $statement->fetch(\PDO::FETCH_ASSOC);
      if(is_array($user)){
        if($user['username'] == $username && password_verify($password, $user['pwhash']))
          return array(true, $username);
      }
      return false;
    }
    return false;
  }

	function getReviews(){
		$sql= "SELECT * from Reviews";
		$ret= $this->pdo->query($sql);
		$items=[];
		foreach ($ret as $row)
			$items[]=$row;
		return $items;
	}

	function putReview($username, $subject, $comment){
    $username =  htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
    $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
    $statement = $this->pdo->prepare("INSERT INTO Reviews(username, timedate, subject, comment)
      VALUES(:username, :timedate, :subject,:comment)");
    $ret = $statement->execute(array(
      ':username' => $username,
			':timedate'=> date('Y-m-d H:i:s'),
      ':subject' => $subject,
      ':comment' => $comment
    ));
    if(!$ret) {
      return false;
    } else {
    	return true;
    }
  }
 }
