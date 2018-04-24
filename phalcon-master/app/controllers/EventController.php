<?php

class EventController extends ControllerBase {

   public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	  $this->checkAuthen();
   }

   public function indexAction(){

   }

   public function tableAction(){
	$servername = "localhost";
	$username = "acequeasy";
	$password = "8Zwq6fYJBFV9RtNn";
	$dbname = "kampang";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset($conn,"utf8");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM events";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		$arrData=array();
		while($row = $result->fetch_assoc()) {
			$arrRows['id']=$row['id'];
			$arrRows['event_name']=$row['event_name'];
			$arrRows['date']=$row['date'];
			$arrRows['detail']=$row['detail'];
			$arrRows['picture']=$row['picture'];
			array_push($arrData, $arrRows);
		}
		return json_encode($arrData);
	} else {
		return "No records matching your query were found.";
	}

	$conn->close();
  }

}
