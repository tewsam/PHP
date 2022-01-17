<?php 
require_once("dbCon.php");
class API{
	
private $con;
public function __construct($con){
	$this->con=$con;
}

/* 
@handle
a public handle to route to the APIs
*/
public function handle($params){

$this->params=$params;
$urlMethod=$this->params['method'];
$customMethod="API_".$urlMethod;
if(!method_exists($this, ${customMethod})) return "method doesn't exist";
return $this->${customMethod}();

	}

//get a fullName of all users	
private function API_fullName(){
	
$stmt = $this->con->query('SELECT  firstName, lastName FROM myUsers');
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

return json_encode($data);
	
}

//get a single user
private function API_singleUser(){

$email=$this->params['email'];
$stmt = $this->con->query("SELECT  firstName, lastName FROM myUsers where email='$email'");
$data = $stmt->fetch();

return $this->foo($data);
	
}


}

public function foo($data){
	return json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
}

}


/* 
normally you expect the request to be
www.stite.com/api?method=singleUser&email=user1@emialserver.com
*/

$_REQUEST['method']='singleUser';
$_REQUEST['email']='user1@emialserver.com';

$params=$_REQUEST;




$api=new API($con);
$api->handle($params);
echo "\n\n";



 ?>