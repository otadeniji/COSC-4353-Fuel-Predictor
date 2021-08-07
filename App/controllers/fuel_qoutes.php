<?php
   
	$arrMsg = [];
	// Set empty form vars for validation mapping
	$Delivery_Address = $Delivery_Date  = "";
	$Gallons = $Suggested_Price_Per_Gallon = $Total_Amount_Due = 0;

   Class FuelQoutes {
   
		public function form_submit($postArr)
		{

			if(isset($postArr["submitQoutes"])) {

				$userId = $_SESSION['id'];
				$Gallons = $postArr["Gallons"];
				$Delivery_Address_C = $postArr["Delivery_Address"];
				$Delivery_Date = $postArr["Delivery_Date"];
				$Suggested_Price_Per_Gallon = $postArr["Suggested_Price_Per_Gallon"];
				$Total_Amount_Due  = $postArr["Total_Amount_Due"];
	
				return $this->CreateFuelQoutes($userId, $Gallons, $Delivery_Address_C, $Delivery_Date, $Suggested_Price_Per_Gallon, $Total_Amount_Due);
			}
		}

		public function CreateFuelQoutes( $userId, $Gallons, $Delivery_Address_C, $Delivery_Date, $Suggested_Price_Per_Gallon, $Total_Amount_Due)
		{
								
			require __DIR__ . "/../config/db.php";
			$arr = [];
			$arr['success_msg'] = '';

			// PHP validation
			// Verify if form values are not empty
			if(!empty($Gallons) && !empty($Delivery_Address_C) && !empty($Delivery_Date) && !empty($Suggested_Price_Per_Gallon) && !empty($Total_Amount_Due)){
            

				// perform validation
				if( $Gallons  <= 0) {
					$arr['GallonsErr'] = 'Gallons should be positive number.';
				}
				if(strlen ( $Delivery_Address_C ) >= 100) {
					$arr['Delivery_AddressErr'] = 'Only 100 characters are allowed.';
				}
				//if( $Delivery_Date >= 100) {
				//    $Delivery_DateErr = '<div class="alert alert-danger">
				//            Date should not be
				//        </div>';
				//}
				if($Suggested_Price_Per_Gallon <= 0) {
					$arr['Suggested_Price_Per_GallonErr']= 'Gallons should be positive number.';
				}
				if(!is_numeric($Total_Amount_Due)) {
					$arr['Total_Amount_DueErr'] = 'Total Amount due should be digit';
				}
                
				// Store the data in db, if all the preg_match condition met
				if(($Gallons  > 0) &&  (strlen ( $Delivery_Address_C ) <= 100) && ($Suggested_Price_Per_Gallon > 0) && (is_numeric($Total_Amount_Due))){

					// Query
					$sql = "INSERT INTO fuel_qoute (Gallons, Delivery_Address, Delivery_Date, Suggested_Price_Per_Gallon, Total_Amount_Due, userId) VALUES ('{$Gallons}', '{$Delivery_Address_C}','{$Delivery_Date}' , '{$Suggested_Price_Per_Gallon}', '{$Total_Amount_Due}', '{$userId}')";

					// Create mysql query
					$sqlQuery = mysqli_query($connection, $sql);
					if(!$sqlQuery){
						die("MySQL query failed!" . mysqli_error($connection));
					}

					if($sqlQuery) {
						 $arr['success_msg'] = 'Successfully added fuel qoutes!';
					}
				}

			} else {
				if(empty($Gallons)){
					$arr['GallonsEmptyErr'] = 'Full name can not be blank.';
				}
				if(empty($Delivery_Address)){
					$arr['Delivery_AddressEmptyErr'] = 'Address 1 can not be blank.';
				}
				if(empty($Delivery_Date)){
					$arr['Delivery_DateEmptyErr'] = 'Delivery date can not be blank.';
				}
				if(empty($Suggested_Price_Per_Gallon)){
					$arr['Suggested_Price_Per_GallonEmptyErr'] = 'City can not be blank.';
				}
				if(empty($Total_Amount_Due)){
					$arr['Total_Amount_DueEmptyErr'] = 'State can not be blank.';
				}
			}

			return $arr;
		}
   }
    
	$FuelQoutesClass_obj = new FuelQoutes;
	$arrMsg = $FuelQoutesClass_obj->form_submit($_POST);
	if($arrMsg == null){
		$arrMsg = [];
	}
	$userId = -1;
	if(!empty($_SESSION))	{ $userId = $_SESSION['id']; }
	require __DIR__ . "/../config/db.php";
	$client_information_result = mysqli_query($connection, "SELECT Address1 FROM users inner join clientInformation as cf ON users.id = cf.userId WHERE users.id = '{$userId}'  ");
	if(mysqli_num_rows($client_information_result) > 0) {
		while($row = mysqli_fetch_array($client_information_result)) {
			$Delivery_Address = $row["Address1"];
		}
	}

?>