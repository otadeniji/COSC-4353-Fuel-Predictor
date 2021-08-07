<?php

	// Database connection
	INCLUDE('App/config/db.php');
	global $wrongPwdErr, $accountNotExistErr, $emailPwdErr, $verificationRequiredErr, $email_empty_err, $pass_empty_err;

   class LoginClass{	

		public function form_submit($postArr){

			if(isset($_POST['login'])) {
				$email_signin        = $postArr['email_signin'];
				$password_signin     = $postArr['password_signin'];
	
				ValidateAndAuthenticateLogin($email_signin, $password_signin);
			}
		}

		public function ValidateAndAuthenticateLogin($email_signin, $password_signin)
		{
			$arr = [];
			$arr['success_msg'] = '';
			// clean data 
			$user_email = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
			$pswd = mysqli_real_escape_string($connection, $password_signin);

			// Query if email exists in db
			$sql = "SELECT * From users WHERE email = '{$email_signin}' ";
			$query = mysqli_query($connection, $sql);
			$rowCount = mysqli_num_rows($query);

			// If query fails, show the reason 
			if(!$query){
			   die("SQL query failed: " . mysqli_error($connection));
			}

			if(!empty($email_signin) && !empty($password_signin)){
				if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $pswd)) {
					$arr['wrongPwdErr'] = 'Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.';
				}
				// Check if email exist
				if($rowCount <= 0) {
					$arr['accountNotExistErr'] = 'User account does not exist.</div>';
				} else {
					// Fetch user data and store in php session
					while($row = mysqli_fetch_array($query)) {
						$id            = $row['id'];
						$email         = $row['email'];
						$pass_word     = $row['password'];
					}

					// Verify password
					$password = password_verify($password_signin, $pass_word);

					// Allow only verified user
					if($email_signin == $email && $password_signin == $password) {

						$_SESSION['id'] = $id;
						$_SESSION['email'] = $email;
						$arr['success_msg'] = "verified successfully.";
						
					} 
					else {
						$arr['emailPwdErr']  = 'Either email or password is incorrect.';
					}

				}
			} else {
				if(empty($email_signin)){
					$arr['email_empty_err'] = "Email not provided.";
				}
            
				if(empty($password_signin)){
					$arr['pass_empty_err'] = "Password not provided.";
				}            
			}
			return $arr;
		}
	}


	$LoginClass_obj = new LoginClass;
	$arrMsg = $LoginClass_obj->form_submit($_POST);
	if($arrMsg != null && $arrMsg['success_msg'] == "verified successfully."){
		header("Location: ./profile.php");
	}
?>    