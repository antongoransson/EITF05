<?php
/**
 * MySQL connnection
 */
class MySQLConnection {
    /**
     * PDO instance
     * @var type
     */
    private $pdo;

    /**
     * return in instance of the PDO object that connects to the MySQL database
     * @return \PDO
     */
    public function connect() {
      include dirname(dirname(dirname(__FILE__))).'/env.php';

      $url = parse_url(getenv('DBURL'));
      $server = $url['host'];
      $username = $url['user'];
      $password = $url['pass'];
      $db = substr($url['path'], 1);

      if ($this->pdo == null) {
        try {
          $this->pdo = new \PDO("mysql:host=$server;dbname=$db", $username, $password);
          $this->pdo->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
        }
      }
      return $this->pdo;
    }
}
