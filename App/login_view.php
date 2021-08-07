	

<?php
	
session_start();
if(!empty($_SESSION)){

	$uId = $_SESSION['id'];
	var_dump($uId);
	die();
	if(	$uId != null || $uId != '' ) 
	{
		header("Location: /FuelPredictor/App/profile_view.php");
		exit();
	}
}
require_once("header.php"); ?>
<!-- Login script -->

<?php require_once(dirname(__FILE__) . './controllers/login.php'); ?>

	<div class="form" style="margin-top:75px;">
	  <div class="tab">
		<div id="register" style="margin-top:100px;">   
			<h1>Welcome Back LOGIN!</h1>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          


			<?php $isaccountNotExistErr = array_key_exists("accountNotExistErr", $arrMsg); 
				if ($isaccountNotExistErr) { ?>
				<div class="alert alert-danger"> <?php echo $arrMsg['accountNotExistErr']; ?> </div>
			<?php } ?>

			<?php if (array_key_exists("emailPwdErr", $arrMsg)) { ?>
				<div class="alert alert-danger"> <?php echo $arrMsg['emailPwdErr']; ?> </div>
			<?php } ?>

			<?php if (array_key_exists("verificationRequiredErr", $arrMsg)) { ?>
				<div class="alert alert-danger"> <?php echo $arrMsg['verificationRequiredErr']; ?> </div>
			<?php } ?>

			<?php if (array_key_exists("email_empty_err", $arrMsg)) { ?>
				<div class="alert alert-danger"> <?php echo $arrMsg['email_empty_err']; ?> </div>
			<?php } ?>

			<?php if (array_key_exists("pass_empty_err", $arrMsg)) { ?>
				<div class="alert alert-danger"> <?php echo $arrMsg['pass_empty_err']; ?> </div>
			<?php } ?>


			 <div class="field-wrap">
				<label>
				  Email Address<span class="req">*</span>
				</label>
				<input type="email" name="email_signin" id="email_signin" required autocomplete="off"/>
			 </div>
          
			 <div class="field-wrap">
				<label>
				  Password<span class="req">*</span>
				</label>
				<input type="password" name="password_signin" id="password_signin"  required autocomplete="off"/>
			 </div>

			<button type="submit" name="login" class="button button-block" >Log In</button>
			<p class="forgot"><a href="./signup_view.php">Are you not member yet? Register</a></p>

			</form>
		</div>
	</div>
</div>




	<script>
		$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
		  var $this = $(this),
			  label = $this.prev('label');

			  if (e.type === 'keyup') {
					if ($this.val() === '') {
				  label.removeClass('active highlight');
				} else {
				  label.addClass('active highlight');
				}
			} else if (e.type === 'blur') {
    			if( $this.val() === '' ) {
    				label.removeClass('active highlight'); 
					} else {
					label.removeClass('highlight');   
					}   
			} else if (e.type === 'focus') {
      
			  if( $this.val() === '' ) {
    				label.removeClass('highlight'); 
					} 
			  else if( $this.val() !== '' ) {
					label.addClass('highlight');
					}
			}
		});

	</script>
</body>

</html>