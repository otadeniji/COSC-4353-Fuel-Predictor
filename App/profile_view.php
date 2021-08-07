<?php   

	session_start();

	$uId = $_SESSION['id'];
	if( $uId == null || $uId == '' )
	{
		header("Location: /FuelPredictor/App/login_view.php");
		exit();
	}
	else{
		
	}
?>
<?php include('./header.php'); ?>
<?php require_once(dirname(__FILE__) . './controllers/profile.php'); ?>


<section class="contact-wrap card " style="margin-top:100px;">



	<h1 style="color: #fff; text-align: left;  font-size: 63px;  font-weight: 700;  padding: 15px;"> 
		<small>Client Profile Management</small>
	</h1>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="contact-form" method="POST">
    
	<div class="col-sm-12">
		<?php if (array_key_exists("success_msg", $arrMsg)) { ?>
			<div class="alert alert-success"> <?php echo $arrMsg['success_msg']; ?> </div>
		<?php } ?>
		
	</div>

	<div class="col-sm-12">
      <div class="input-block">
        <label for="">Full Name (<span style="color:red">*</span>)</label>

			<input type="text" class="form-control" name="FullName" id="FullName" value="<?php echo $ClientProfileInformation_obj->FullName ?>" />

			<?php if (array_key_exists("fullNameEmptyErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['fullNameEmptyErr']; ?> </div>
			<?php } ?>

			<?php if (array_key_exists("full_NameErr", $arrMsg)) { ?>
				<div class="alert alert-danger"> <?php echo $arrMsg['full_NameErr']; ?> </div>
			<?php } ?>
      </div>
    </div>
    
	<div class="col-sm-12">
		<div class="input-block">
       		<label for="">Address 1 (<span style="color:red">*</span>)</label>
			<input type="text" class="form-control" name="Address1" id="Address1"  value="<?php echo $ClientProfileInformation_obj->Address1 ?>"/>

			<?php if (array_key_exists("Address1Err", $arrMsg)) { ?>
				<div class="alert alert-danger"> <?php echo $arrMsg['Address1Err']; ?> </div>
			<?php } ?>

			<?php if (array_key_exists("Address1EmptyErr", $arrMsg)) { ?>
				<div class="alert alert-danger"> <?php echo $arrMsg['Address1EmptyErr']; ?> </div>
			<?php } ?>
		</div>
    </div>

    <div class="col-sm-12">
      <div class="input-block">
        <label for="">Address 2</label>
		<input type="text" class="form-control" name="Address2" id="Address2" value="<?php echo $ClientProfileInformation_obj->Address2 ?>" />

		<?php if (array_key_exists("Address2Err", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['Address2Err']; ?> </div>
		<?php } ?>
      </div>
    </div>

    <div class="col-sm-12">
      <div class="input-block">
        <label for="">City (<span style="color:red">*</span>)</label>
		<input type="text" class="form-control" name="City" id="City" value="<?php echo $ClientProfileInformation_obj->City ?>" />

		<?php if (array_key_exists("CityErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['CityErr']; ?> </div>
		<?php } ?>

		<?php if (array_key_exists("CityEmptyErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['CityEmptyErr']; ?> </div>
		<?php } ?>
      </div>
    </div>

    <div class="col-sm-12">
      <div class="input-block textarea">		
		<select  name="State" id="State" style=" width: 100%;  height: 50px;  border: 1px solid #eee; padding: 12px; "> 

			<?php 		
				// Read the JSON file 
				$json = file_get_contents( 'states.json' );
  
				// Decode the JSON file
				$json_data = json_decode( $json, true ); 
				$json_states = $json_data['states'];
				foreach($json_states as $item) { 
					$state = $item['abbreviation'];
					if($ClientProfileInformation_obj->State == $state) { ?>

						<option value="<?php echo $state ?>" selected> <?php echo $state ?> </option>

		       <?php } else { ?> 

						<option value="<?php echo $state ?>"> <?php echo $state ?> </option>

					 <?php } ?>
          <?php } ?>

		</select>
		
		<?php if (array_key_exists("StateErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['StateErr']; ?> </div>
		<?php } ?>

		<?php if (array_key_exists("StateEmptyErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['StateEmptyErr']; ?> </div>
		<?php } ?>

      </div>
    </div>

	<div class="col-sm-12">
      <div class="input-block textarea">

		<label for="">ZipCode(<span style="color:red">*</span>)</label>
		<input type="text" class="form-control" name="ZipCode" id="ZipCode" value="<?php echo $ClientProfileInformation_obj->ZipCode ?>" />

		<?php if (array_key_exists("ZipCodeErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['ZipCodeErr']; ?> </div>
		<?php } ?>

		<?php if (array_key_exists("ZipCodeEmptyErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['ZipCodeEmptyErr']; ?> </div>
		<?php } ?>

      </div>
    </div>

    <div class="col-sm-12">
      <button type="submit" class="square-button" name="submit" > Submit Profile </button>
    </div>
  </form>

</section>

	<script>

		//material contact form animation
		$('.contact-form').find('.form-control').each(function() {
		  var targetItem = $(this).parent();
		  if ($(this).val()) {
			$(targetItem).find('label').css({
			  'top': '10px',
			  'fontSize': '14px'
			});
		  }
		});

		$('.contact-form').find('.form-control').focus(function() {
		  $(this).parent('.input-block').addClass('focus');
		  $(this).parent().find('label').animate({
			'top': '10px',
			'fontSize': '14px'
		  }, 300);
		});

		$('.contact-form').find('.form-control').blur(function() {
		  if ($(this).val().length == 0) {
			$(this).parent('.input-block').removeClass('focus');
			$(this).parent().find('label').animate({
			  'top': '25px',
			  'fontSize': '18px'
			}, 300);
		  }
		});

	</script>

</body>
</html>