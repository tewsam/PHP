<?php 

// Connect db without a singleton.
class ConnectDB {
  private static $instance = null;
  private $conn;
  
  private $host = '127.0.0.1';
  private $user = 'root';
  private $pass = 'bereket#3';
  private $name = 'test';
   
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


// $host = '127.0.0.1';
// $db   = 'test';
// $user = 'root';
// $pass = 'bereket#3';
// $charset = 'utf8mb4';

// $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
// $options = [
//     PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//     PDO::ATTR_EMULATE_PREPARES   => false,
// ];
// // var_dump(PDO::ATTR_DEFAULT_FETCH_MODE);
// try {
//      $con = new PDO($dsn, $user, $pass, $options);
// } catch (\PDOException $e) {
//      throw new \PDOException($e->getMessage(), (int)$e->getCode());
// }

//END CONNECTION 

// $instance = ConnectDb::getInstance();
// $con = $instance->getConnection();
// // var_dump($con);

// $stmt = $con->query('SELECT firstName FROM myUsers');
// $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo json_encode($data);


// $arr=[];
// $i=0;
// while ($row = $stmt->fetch())
// {
//     $arr[$i]= $row;
//     $i++;
// }
// echo json_encode(['sucess'=>$arr]);
 ?>