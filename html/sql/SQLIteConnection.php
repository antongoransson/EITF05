<?php
namespace SQL;

/**
 * SQLite connnection
 */
class SQLiteConnection {
    /**
     * PDO instance
     * @var type
     */
    private $pdo;

    /**
     * return in instance of the PDO object that connects to the SQLite database
     * @return \PDO
     */
    public function connect() {
      $dir = dirname(dirname(__FILE__));
      $baseDir = dirname($dir);
        if ($this->pdo == null) {
            $this->pdo = new \PDO("sqlite:" . $baseDir.'/html/'.Config::PATH_TO_SQLITE_FILE);
        }
        return $this->pdo;
    }
}
