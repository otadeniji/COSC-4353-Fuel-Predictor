<?php
   
    // Database connection

	Class Fuel_Qoutes_History 
	{
		
		public function fetch_information()
		{
			require __DIR__ . "/../config/db.php";
			$sql = "SELECT * FROM fuel_qoute";
			$result = mysqli_query($connection, $sql);
			return $result;
		}
	}

	$Fuel_Qoutes_History_obj = new Fuel_Qoutes_History;
	$result = $Fuel_Qoutes_History_obj->fetch_information();

?>