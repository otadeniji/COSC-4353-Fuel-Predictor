
<?php
   
	$arrMsg = [];
	// Set empty form vars for validation mapping
	$_email = $_password = "";

class RegisterClass{	

	public function form_submit($postArr){
		if(isset($postArr["register"])) {
			$email      = $postArr['email'];
			$password     = $postArr['password'];
			return $this->VAlidateAndCreateUser($email, $password);
		}
	}

	public function VAlidateAndCreateUser($email, $passwordUser)
	{

		require __DIR__ . "/../config/db.php";
		$arr = [];
		$arr['success_msg'] = '';
		// check if email already exist

		// perform validation
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$arr['emailErr'] = 'Email format is invalid.';
			return $arr;
		}

		if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $passwordUser)) {
			$arr['passwordErr'] = 'Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.';
			return $arr;
		}

		$email_check_query = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$email}' ");
		$rowCount = mysqli_num_rows($email_check_query);


		// PHP validation
		// Verify if form values are not empty
		if( !empty($email) && !empty($passwordUser)){
            
			// check if user email already exist
			if($rowCount > 0) {
				$arr['email_exist'] = 'User with email already exist!';
			} 
			else {

				// Store the data in db, if all the preg_match condition met
				if( (filter_var($email, FILTER_VALIDATE_EMAIL)) && 
					(preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $passwordUser))) {

					// Password hash
					$password_hash = password_hash($passwordUser, PASSWORD_BCRYPT);

					// Query
					$sql = "INSERT INTO users ( email, password ) VALUES ( '{$email}', '{$password_hash}')";
                    
					// Create mysql query
					$sqlQuery = mysqli_query($connection, $sql);
                    
					if(!$sqlQuery){
						die("MySQL query failed!" . mysqli_error($connection));
					} 

					// Send verification Message
					if($sqlQuery) {
						$arr['email_verify_success'] = 'Successfully registered on Fuel predictor!';
						$arr['success_msg'] = 'Registered successfully.';
					}
				}
			}
		}
		return $arr;
	}
}

$RegisterClass_obj = new RegisterClass;
$arrMsg = $RegisterClass_obj->form_submit($_POST);
if($arrMsg == null) { $arrMsg = []; }

?>