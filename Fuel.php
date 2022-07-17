<?php
class Fuel{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "petrolapp";   
	private $fuelUserTable = 'fuel_user';	
    private $fuelOrderTable = 'fuel_order';
	private $fuelOrderItemTable = 'fuel_order_item';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	public function loginUsers($email, $password){
		$sqlQuery = "
			SELECT id, email, first_name, last_name, address, mobile 
			FROM ".$this->fuelUserTable." 
			WHERE email='".$email."' AND password='".$password."'";
        return  $this->getData($sqlQuery);
	}	
	public function checkLoggedIn(){
		if(!$_SESSION['userid']) {
			header("Location:index.php");
		}
	}		
	public function savefuel($POST) {		
		$sqlInsert = "INSERT INTO ".$this->fuelOrderTable."(user_id,  order_amount_paid, type_of_fuel,month_of_order) VALUES ('".$POST['userId']."', '".$POST['subTotal']."' , '".$POST['fuel_type']."', '".$POST['monthly']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['productCode']); $i++) {
			 $sqlInsertItem = "INSERT INTO ".$this->fuelOrderItemTable."(order_id, item_code, order_item_quantity, order_item_price, order_item_final_amount) VALUES ('".$lastInsertId."', '".$POST['productCode'][$i]."',  '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}       	
	}	
	public function updatefuel($POST) {
  
		if($POST['fuelId']) {	
			$sqlInsert = "UPDATE ".$this->fuelOrderTable." 
				SET   order_amount_paid = '".$POST['subTotal']."', type_of_fuel = '".$POST['fuel_type']."' , month_of_order = '".$POST['monthly']."'  
				WHERE user_id = '".$POST['userId']."' AND order_id = '".$POST['fuelId']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);	
		}		
		 $this->deletefuelItems($POST['fuelId']);
		for ($i = 0; $i < count($POST['productCode']); $i++) {			
			  $sqlInsertItem = "INSERT INTO ".$this->fuelOrderItemTable."(order_id, item_code,  order_item_quantity, order_item_price, order_item_final_amount) 
				VALUES ('".$POST['fuelId']."', '".$POST['productCode'][$i]."' , '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);			
		} 
	       	
	}	
	public function getfuelList(){
		  $sqlQuery = "SELECT * FROM ".$this->fuelOrderTable." 
			WHERE user_id = '".$_SESSION['userid']."'";
		return  $this->getData($sqlQuery);
	}	
	public function getfuel($fuelId){
		$sqlQuery = "SELECT * FROM ".$this->fuelOrderTable." 
			WHERE user_id = '".$_SESSION['userid']."' AND order_id = '$fuelId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	
	public function getfuelItems($fuelId){
		$sqlQuery = "SELECT * FROM ".$this->fuelOrderItemTable." 
			WHERE order_id = '$fuelId'";
		return  $this->getData($sqlQuery);	
	}
	
	public function deletefuelItems($fuelId){
		$sqlQuery = "DELETE FROM ".$this->fuelOrderItemTable." 
			WHERE order_id = '".$fuelId."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}
	
}
?>