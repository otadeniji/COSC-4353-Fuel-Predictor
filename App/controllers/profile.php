<?php
   
    $arrMsg = [];

    // Database connection
	require_once( dirname(__FILE__).'/../config/db.php');


	Class ClientProfileInformation {
		public $userId; 
		public $FullName;
		public $Address1;
		public $Address2 ;
		public $City ;
		public $State;
		public $ZipCode;


		public function form_submit($postArr){
			 
			if(isset($postArr["submit"])) {
				//var_dump('entered');
				$this->userId = $_SESSION["id"];
				$this->FullName = $postArr["FullName"];
				$this->Address1 = $postArr["Address1"];
				$this->Address2 = $postArr["Address2"];
				$this->City  = $postArr["City"];
				$this->State = $postArr["State"];
				$this->ZipCode = $postArr["ZipCode"];
				
				return $this->CreateClientProfile($this->userId, $this->FullName, $this->Address1, $this->Address2, $this->City, $this->State, $this->ZipCode);
			}
			else {
				//var_dump('entered1');
				require __DIR__ . "/../config/db.php";
				$userId = '';
				if(isset($_SESSION)){
					$userId = $_SESSION["id"];
				}
				
				$result = mysqli_query($connection, "SELECT * FROM users inner join clientInformation as cf ON users.id = cf.userId WHERE users.id = '{$userId}' ");
				
				if(mysqli_num_rows($result) > 0){

					while($row = mysqli_fetch_array($result)){
						//var_dump($row);
						$this->FullName = $row["FullName"];
						$this->Address1 = $row["Address1"];
						$this->Address2 = $row["Address2"];
						$this->City  = $row["City"];
						$this->State = $row["State"];
						$this->ZipCode = $row["ZipCode"];
					}
				}
			}
	
		}

		public function CreateClientProfile($userId, $FullName, $Address1, $Address2, $City, $State, $ZipCode) {
		
			require __DIR__ . "/../config/db.php";
			$arr = [];
			$arr['success_msg'] = '';
			// check if email already exist
			$email_check_query = mysqli_query($connection, "SELECT * FROM users inner join clientInformation as cf ON users.id = cf.userId WHERE users.id = '{$userId}'  ");
			$rowCount = mysqli_num_rows($email_check_query);

			// PHP validation
			// Verify if form values are not empty
			if(!empty($FullName) && !empty($Address1) && !empty($City) && !empty($State) && !empty($ZipCode)) {
            
				// perform validation
				if(strlen ( $FullName ) > 50) {
					$arr['full_NameErr'] = 'Only 50 characters are allowed.';
				}
				if(strlen ( $Address1 ) >= 100) {
					$arr['Address1Err'] = 'Only 100 characters are allowed.';
				}
				if(strlen ( $Address2 ) >= 100) {
					$arr['Address2Err'] = 'Only 100 characters are allowed.';
				}
				if(strlen ( $City ) >= 100) {
					$arr['CityErr'] = 'Email format is invalid.';
				}
				if(strlen ( $State ) != 2) {
					$arr['StateErr'] = 'Only 2 characters allowed for state code.';
				}
				if(strlen ( $ZipCode ) <= 5 && strlen ( $ZipCode ) > 9) {
					$arr['ZipCodeErr'] = 'Zip Code length should be min 5 and max 9';
				}
                
				// Store the data in db, if all the preg_match condition met
				if((strlen ( $FullName ) < 50) && (strlen ( $Address1 ) < 100) &&
					(strlen ( $City ) < 100) && (strlen ( $State ) == 2) && (strlen ( $ZipCode ) >= 5 && strlen ( $ZipCode ) < 9)) {
					//var_dump($ZipCode);
					// Query
					if($rowCount <= 0){
						 $sql = "INSERT INTO ClientInformation (FullName, Address1, Address2, City, State, ZipCode, date_time, userId) VALUES ('{$FullName}', '{$Address1}', '{$Address2}', '{$City}', '{$State}', '{$ZipCode}' , 'now()', '{$userId}')";
					}
					else{
					 $sql = "Update ClientInformation SET FullName = '{$FullName}', Address1 = '{$Address1}', Address2 = '{$Address2}', City = '{$City}', State = '{$State}', ZipCode = '{$ZipCode}' Where userId = '{$userId}'";
					}
					 // Create mysql query

					 //die();
					$sqlQuery = mysqli_query($connection, $sql);
					if(!$sqlQuery){
						die("MySQL query failed!" . mysqli_error($connection));
					} 
					// Send Confirmation
					if($sqlQuery) {
					//var_dump('entered');
						 $arr['success_msg'] = 'Successfully updated your profile!';
					}
				}
			} 
			else {

				if(empty($FullName)){
					$arr['fullNameEmptyErr'] = 'Full name can not be blank.';
				}
				if(empty($Address1)){
					$arr['Address1EmptyErr'] = 'Address 1 can not be blank.';
				}
				if(empty($City)){
					$arr['CityEmptyErr'] = 'City can not be blank.';
				}
				if(empty($State)){
					$arr['StateEmptyErr'] = 'State can not be blank.';
				}
				if(empty($ZipCode)){
					$arr['ZipCodeEmptyErr'] = 'Zip code can not be blank.';
				}     
			}
			return $arr;
		}
	}


	$ClientProfileInformation_obj = new ClientProfileInformation;
	$arrMsg = $ClientProfileInformation_obj->form_submit($_POST);
	if($arrMsg == null){
		$arrMsg = [];
	}

?>