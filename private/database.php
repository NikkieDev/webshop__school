<?php
class Database
{
  private $pdo;

  public function __construct()
  {
    try {
      $this->pdo = new PDO(
          'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
          DB_USER, 
          DB_PASS,
          [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          ]
      );
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }

  public function getConnection()
  {
    if ($this->pdo == null) {
      throw new PDOException("PDO is not initialized");
    }
    
    return $this->pdo;
  }

  public function __destruct()
  {
    $this->pdo = null;
  }
}
