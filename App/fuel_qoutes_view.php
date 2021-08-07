

<?php   

	session_start();
	$uId = $_SESSION['id'];

	if( $uId == null || $uId == '' ){
		header("Location: ./login_view.php");
		exit();
	}
?>
<?php require_once(dirname(__FILE__) . './controllers/fuel_qoutes.php'); ?>
<?php include('./header.php'); ?>

<section class="contact-wrap card"  style="margin-top:100px;">
<h1 style="color: #fff; text-align: left;  font-size: 63px;  font-weight: 700;  padding: 15px;"> 
	<small>Fuel Qoutes</small>
</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="contact-form" method="POST">
    <div class="col-sm-12">

	  <?php
	  
			//var_dump($_SESSION['id']);
			if (array_key_exists("success_msg", $arrMsg) && $arrMsg['success_msg'] != '') { ?>
			<div class="alert alert-success"> <?php echo $arrMsg['success_msg']; ?> </div>
	  <?php } ?>

      <div class="input-block">

		<label>Gallons (<span style="color:red">*</span>)</label>
		<input type="text" class="form-control" name="Gallons" id="Gallons" />
		<span style="color:red;" id="gallonIdErr"></span>
		<?php if (array_key_exists("GallonsErr", $arrMsg)) { ?>
		<div class="alert alert-danger"> <?php echo $arrMsg['GallonsErr']; ?> </div>
		<?php } ?>

		<?php if (array_key_exists("GallonsEmptyErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['GallonsEmptyErr']; ?> </div>
		<?php } ?>
      </div>
    </div>

    <div class="col-sm-12">

		<div class="input-block">
       		<label>Delivery Address (<span style="color:red">*</span>)</label>
			<input type="text" class="form-control" name="Delivery_Address" id="Delivery_Address" value="<?php echo $Delivery_Address ?>"  readonly="readonly" />

			<?php if (array_key_exists("Delivery_AddressErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['Delivery_AddressErr']; ?> </div>
			<?php } ?>

			<?php if (array_key_exists("Delivery_AddressEmptyErr", $arrMsg)) { ?>
				<div class="alert alert-danger"> <?php echo $arrMsg['Delivery_AddressEmptyErr']; ?> </div>
			<?php } ?>
		</div>

    </div>
    <div class="col-sm-12">

      <div class="input-block">
        	<label>Delivery Date (<span style="color:red">*</span>)</label>
			<input type="text" class="form-control" name="Delivery_Date" id="Delivery_Date"  />
			<span style="color:red;" id="Delivery_DateErr"></span>
			<?php if (array_key_exists("Delivery_DateErr", $arrMsg)) { ?>
				<div class="alert alert-danger"> <?php echo $arrMsg['Delivery_DateErr']; ?> </div>
			<?php } ?>

			<?php if (array_key_exists("Delivery_DateEmptyErr", $arrMsg)) { ?>
				<div class="alert alert-danger"> <?php echo $arrMsg['Delivery_DateEmptyErr']; ?> </div>
			<?php } ?>
      </div>

    </div>
    <div class="col-sm-12">

      <div class="input-block">
        <label>Suggested Price Per Gallon</label>
		<input type="text" class="form-control" name="Suggested_Price_Per_Gallon" id="Suggested_Price_Per_Gallon" readonly="readonly" />

		<?php if (array_key_exists("Suggested_Price_Per_GallonErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['Suggested_Price_Per_GallonErr']; ?> </div>
		<?php } ?>

		<?php if (array_key_exists("Suggested_Price_Per_GallonEmptyErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['Suggested_Price_Per_GallonEmptyErr']; ?> </div>
		<?php } ?>
      </div>

    </div>

    <div class="col-sm-12">
      <div class="input-block textarea">

		<label>Total Amount Due</label>
		<input type="text" class="form-control" name="Total_Amount_Due" id="Total_Amount_Due" readonly="readonly" />

										
		<?php if (array_key_exists("Total_Amount_DueEmptyErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['Total_Amount_DueEmptyErr']; ?> </div>
		<?php } ?>

		<?php if (array_key_exists("Total_Amount_DueEmptyErr", $arrMsg)) { ?>
			<div class="alert alert-danger"> <?php echo $arrMsg['Total_Amount_DueEmptyErr']; ?> </div>
		<?php } ?>


      </div>
    </div>
	<div class="row"> 
		<div class="col-sm-6">
		  <button type="button" name="getQoutes" id="getQoutes" class="square-button" disabled>Get Fuel Qoutes</button>
		</div>
		<div class="col-sm-6">
		  <button type="submit" name="submitQoutes" id="submitQoutes" class="square-button" disabled>Submit Fuel Qoutes</button>
		</div>
	</div>
    
  </form>
</section>






<script>

	$(document).ready(function(){
		
		$('#Delivery_Date').datetimepicker({
			format:'Y/m/d',
			onSelectDate:function (val) {
			}
		});

		$('#getQoutes').click(function(e){
			debugger;
			e.preventDefault();

			var gallons = $('#Gallons').val();
			GetQoutes(gallons);
			return false;
		});

		function GetQoutes(gallons)
		{
			$.ajax({
				url:"/FuelPredictor/App/controllers/pricing.php",    //the page containing php script
				type: "GET",    //request type,
				data: {getQoutes: "success", gallons: gallons },
				success:function(response){
					debugger;

					var res = response.split('|');
					$('#Suggested_Price_Per_Gallon').val(res[0]);
					$('#Total_Amount_Due').val(res[1]);

					$('#Suggested_Price_Per_Gallon').parent('.input-block').addClass('focus');
					$('#Suggested_Price_Per_Gallon').parent().find('label').animate({
						'top': '10px',
						'fontSize': '14px'
					  }, 300);

					$('#Total_Amount_Due').parent('.input-block').addClass('focus');
					$('#Total_Amount_Due').parent().parent().find('label').animate({
						'top': '10px',
						'fontSize': '14px'
					  }, 300);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					debugger;
				   console.log(textStatus, errorThrown);
				}
			});
		}

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
					if($(this).attr('id') == 'Suggested_Price_Per_Gallon' || $(this).attr('id') == 'Total_Amount_Due' ){
				return false;
			}
		  $(this).parent('.input-block').addClass('focus');
		  $(this).parent().find('label').animate({
			'top': '10px',
			'fontSize': '14px'
		  }, 300);
		});

		$('.contact-form').find('.form-control').blur(function() {
					if($(this).attr('id') == 'Suggested_Price_Per_Gallon' || $(this).attr('id') == 'Total_Amount_Due' ){
				return false;
			}
		  if ($(this).val().length == 0) {
			$(this).parent('.input-block').removeClass('focus');
			$(this).parent().find('label').animate({
			  'top': '25px',
			  'fontSize': '18px'
			}, 300);
		  }
		});

		$('.contact-form').find('.form-control').change(function() {
			//if($(this).attr('id') == 'Suggested_Price_Per_Gallon' || $(this).attr('id') == 'Total_Amount_Due' ){
			//	return false;
			//}
			if ($(this).val().length == 0) {
				$(this).parent('.input-block').removeClass('focus');
				$(this).parent().find('label').animate({
				'top': '25px',
				'fontSize': '18px'
				}, 300);
			}
		});

		$('#Gallons').change(function(){
			if($.isNumeric($('#Gallons').val()))
			{
				$('#gallonIdErr').text('');
			}
			else{
				$('#gallonIdErr').text('Invalid Gallon, Only digits are allowed');
			}

			if($.isNumeric($('#Gallons').val()) && 
				( $('Delivery_Address').val() != '' && $('#Delivery_Address').val() !== undefined )  &&
				( $('Delivery_Date').val() != '' && $('#Delivery_Date').val() !== undefined ) ){
					$('#getQoutes').attr('disabled', false);
					$('#submitQoutes').attr('disabled', false);
				}
				else{

					
					$('#getQoutes').attr('disabled', true);
					$('#submitQoutes').attr('disabled', true);
				}
		});

		$('#Delivery_Address').change(function(){
		
			if($.isNumeric($('#Gallons').val()) && 
				($('Delivery_Address').val() != '' && $('#Delivery_Address').val() !== undefined )  &&
				($('Delivery_Date').val() != '' && $('#Delivery_Date').val() !== undefined) ){
					$('#getQoutes').attr('disabled', false);
					$('#submitQoutes').attr('disabled', false);
				}
				else{
					$('#getQoutes').attr('disabled', true);
					$('#submitQoutes').attr('disabled', true);
				}
		});

		$('#Delivery_Date').change(function(){

			if($('Delivery_Date').val() != '' && $('#Delivery_Date').val() !== undefined )
			{
				$('#Delivery_DateErr').text('');
			}
			else{
				$('#Delivery_DateErr').text('Delivery date cannot be empty');
			}

			if(  $.isNumeric($('#Gallons').val()) && 
				($('Delivery_Address').val() != '' && $('#Delivery_Address').val() !== undefined )  &&
				($('Delivery_Date').val() != '' && $('#Delivery_Date').val() !== undefined) )
				{
					$('#getQoutes').attr('disabled', false);
					$('#submitQoutes').attr('disabled', false);
				}
				else{

					$('#getQoutes').attr('disabled', true);
					$('#submitQoutes').attr('disabled', true);
				}
		});
	});



	</script>

</body>

</html>