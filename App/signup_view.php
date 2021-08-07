
<?php require_once("header.php"); ?>
<!-- Login script -->

<?php require_once(dirname(__FILE__) . './controllers/register.php'); ?>

	<div class="form" style="margin-top:75px;">
	  <div class="tab">
		<div id="register" style="margin-top:100px;">   
			<h1>Client Registration!</h1>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          
				<?php 
					if( array_key_exists("email_verify_success", $arrMsg) )
					{ ?>

						
						<div class="alert alert-success"><h5>  <?php echo $arrMsg['email_verify_success']; ?> </h5></div>
						<a class="btn btn-outline-primary btn-lg btn-block" href="./login_view.php">Redirect to LogIn</a>

					<?php
					}
					else { ?>

						<?php if (array_key_exists("email_exist", $arrMsg)) { ?>
						<div class="alert alert-danger"> <?php echo $arrMsg['email_exist']; ?> </div>
						<?php } ?>

						<?php if (array_key_exists("email_verify_err", $arrMsg)) { ?>
							<div class="alert alert-danger"> <?php echo $arrMsg['email_verify_err']; ?> </div>
						<?php } ?>



						<div class="field-wrap">
							<label>
								Email Address<span class="req">*</span>
							</label>
							<input type="email" name="email" id="email_signin" required autocomplete="off"/>
							
							<?php if (array_key_exists("emailErr", $arrMsg)) { ?>
							<div class="alert alert-danger"> <?php echo $arrMsg['emailErr']; ?> </div>
							<?php } ?>

							<?php if (array_key_exists("emailEmptyErr", $arrMsg)) { ?>
								<div class="alert alert-danger"> <?php echo $arrMsg['emailEmptyErr']; ?> </div>
							<?php } ?>
						</div>


						<div class="field-wrap">
							<label>
								Password<span class="req">*</span>
							</label>
							<input type="password" name="password" id="password_signin"  required autocomplete="off"/>
							<?php if (array_key_exists("passwordErr", $arrMsg)) { ?>
								<div class="alert alert-danger"> <?php echo $arrMsg['passwordErr']; ?> </div>
							<?php } ?>

							<?php if (array_key_exists("passwordEmptyErr", $arrMsg)) { ?>
								<div class="alert alert-danger"> <?php echo $arrMsg['passwordEmptyErr']; ?> </div>
							<?php } ?>
						</div>

						<button class="button button-block" type="submit" name="register">Sign up</button>
						<p class="forgot" style="margin-top:30px;"> <a href="./login_view.php">Already Registered? Login Now</a></p>

					<?php } ?>
			</form>
		</div>
	</div>
</div>


</body>

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
</html>