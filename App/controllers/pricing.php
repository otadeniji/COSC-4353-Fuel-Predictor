<?php
   
	
	Class PricingModule {

		// Set empty form vars for validation mapping
		public function Get_Qoutes($gallons) {

			require __DIR__ . "/../config/db.php";
			$currentPricePerGallon = 1.50;
			$Location_Factor_per = 0;
			$Rate_History_factor_per = 0;
			$Gallons_Request_factor_per = 0;
			$Company_Profit_Factor_Per = 0.10 ;

			$Gallons = $gallons ;
			// condition 1 for gallons
			if($Gallons > 1000){
				$Gallons_Request_factor_per = 0.2;
			}
			else{
				$Gallons_Request_factor_per = 0.3;
			}


			$State = '';
			$userId = 1;
			if(isset($_SESSION)){
				$userId = $_SESSION['id'];
			}
			
			if($userId != null && !empty($userId))
			{
				$sql = "SELECT * From ClientInformation WHERE userId = '{$userId}' ";
				$query = mysqli_query($connection, $sql);
				$rowCount = mysqli_num_rows($query);
				while($row = mysqli_fetch_array($query)) {
					$State = $row['State'];
				}
			}
			//Condition 2 for state. I am getting from database current logged in client state.
			if($State == 'TX'){
				$Location_Factor_per = 0.2;
			}
			else{
				$Location_Factor_per = 0.4;
			}

			$rowCount = 0;
			if($userId != null && !empty($userId))
			{
				$sql = "SELECT * From fuel_qoute WHERE userId = '{$userId}' ";
				$query = mysqli_query($connection, $sql);
				$rowCount = mysqli_num_rows($query);
				
			}
			//Here i am checking user have purchased before or not.
			if($rowCount > 0){
				$Rate_History_factor_per = 0.1;
			}
			else{
				$Rate_History_factor_per = 0.0;
			}

			//Here formula applied
			$Margin = $currentPricePerGallon * ($Location_Factor_per - $Rate_History_factor_per + $Gallons_Request_factor_per + $Company_Profit_Factor_Per);
			

			$Suggested_Price_Per_Gallon = (float)$currentPricePerGallon + (float)$Margin;
			
			$Total_Amount_Due = $gallons * $Suggested_Price_Per_Gallon;
			//After calculation i am returning it.
			$arrQoutest = [];
			$arrQoutest['Suggested_Price_Per_Gallon'] = $Suggested_Price_Per_Gallon;
			$arrQoutest['Total_Amount_Due'] = $Total_Amount_Due;

			return $arrQoutest;
		}
	}

    if (isset($_GET['getQoutes'])) 
	{
			$PricingModule_obj = new PricingModule;
			$gallons = $_GET['gallons'];
			echo implode( "|" , $PricingModule_obj->Get_Qoutes($gallons));
    }

?>