<?php 

// Connect db without a singleton.
class ConnectDB {
  private static $instance = null;
  private $conn;
  
  private $host = '127.0.0.1';
  private $user = 'root';
  private $pass = 'mypass';
  private $name = 'dbName';
   
  // The db connection is established in the private constructor.
  private function __construct()
  {
$options = [
    PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
];

    $this->conn = new PDO("mysql:host={$this->host};dbname={$this->name}", $this->user,$this->pass, $options);
  }
  
  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new ConnectDB();
    }
   
    return self::$instance;
  }
  
  public function getConnection()
  {
    return $this->conn;
  }
}

$instance = ConnectDB::getInstance();
$con = $instance->getConnection();

 ?>