<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../App/controllers/login.php";
require __DIR__ . "/../App/controllers/register.php";
require __DIR__ . "/../App/controllers/profile.php";
require __DIR__ . "/../App/controllers/fuel_qoutes.php";
require __DIR__ . "/../App/controllers/pricing.php";
require __DIR__ . "/../App/controllers/fuel_qoutes_history.php";


class AppFuelPredictorTest extends TestCase {


	//Each functions has test 

	//I am passing wrong values, if value is wrong then test failed. 
	// When test pass, then no failure. Unit testing skip that. PHPUnit Test cases are written there. 
	//Inherited this testcase namespaces
	//And also created html report for test cases using phpunit.



	//Registration Tests
	//First test case
	//Passing 

	public function testFormSubmitRegister() {
		
		$expected = "Registered successfully.";
		$register = [];
		$register['register'] = 1;
		$register['email'] = 'aliha12345@gmail.com';
		$register['password'] = 'Bcsf12@027';

        $calc = new RegisterClass;
		$result = $calc->form_submit($register);
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertEquals($expected,'');
		}
	}

	//This test will be failed. because wrong values passed.
	public function testValidateEmptyEmailRegister() {
		
		$expected = "Registered successfully.";
        $calc = new RegisterClass();
		$result = $calc->VAlidateAndCreateUser('','Bcsf12@027');
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertEquals($expected,'');
		}
	}

	public function testValidateEmptyEmailAndPasswordRegister() : void
	{
		$expected = "verified successfully.";
        $calc = new RegisterClass();
        
		$result = $calc->VAlidateAndCreateUser('','');
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected,$result['success_msg']);
		}
		else{
			$this->assertSame($expected,'', 'Failure');
		}
    } 

	public function testValidateFakeEmailRegister() {
		
		$expected = "Registered successfully.";
        $calc = new RegisterClass();
		$result = $calc->VAlidateAndCreateUser('fake_email','Bcsf12@027');
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertEquals($expected,'');
		}
	}

	public function testValidateExistingUserRegistration() {

		$expected = "Registered successfully.";
        $calc = new RegisterClass();
		$result = $calc->VAlidateAndCreateUser('alihassan87613@gmail.com','Bcsf12@027');
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertEquals($expected,'');
		}
    }

	public function testValidatePasswordRegistration() {

		$expected = "Registered successfully.";
        $calc = new RegisterClass();
		$result = $calc->VAlidateAndCreateUser('ali876133@gmail.com','');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertEquals($expected,'');
		}
    }

	public function testValidateAndCreateUser() {

		$expected = "Registered successfully.";
        $calc = new RegisterClass();
        $result = $calc->VAlidateAndCreateUser('test@gmail.com','Bcsf12@027');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertEquals($expected,'');
		}
	}

	public function testFormSubmitLogin() {
		
		$expected = "verified successfully.";
		$login = [];
		$login['login'] = 1;

		$login['email_signin'] = 'alihassan87613@gmail.com';
		$login['password_signin'] = 'Bcsf12@027';
		
        $calc = new LoginClass;
		$result = $calc->form_submit($login);
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertEquals($expected,'');
		}
	}

	public function testFormSubmitWithoutLogin() {
		
		$expected = "verified successfully.";
		$register = [];
		$register['login'] = 0;

		$register['email_signin'] = 'alihassan87613@gmail.com';
		$register['password_signin'] = 'Bcsf12@027';
		
        $calc = new LoginClass;
		$result = $calc->form_submit($register);
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertEquals($expected,'');
		}
	}

	public function testValidateFakeEmailLogin() : void
	{
		$expected = "verified successfully.";
        $calc = new LoginClass();
		$result = $calc->ValidateAndAuthenticateLogin('fake_email','Bcsf12@027');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected,$result['success_msg']);
		}
		else{
			$this->assertSame($expected,'');
		}
	}

	public function testValidateEmptyEmailLogin() : void
	{
		$expected = "verified successfully.";
        $calc = new LoginClass();
		$result = $calc->ValidateAndAuthenticateLogin('','Bcsf12@027');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected,$result['success_msg']);
		}
		else{
			$this->assertSame($expected,'');
		}
	}

    public function testValidateAndAuthenticateLogin() : void
	{
		$expected = "verified successfully.";
        $calc = new LoginClass();
        
		$result = $calc->ValidateAndAuthenticateLogin('test@gmail.com','Bcsf12@027');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected,$result['success_msg']);
		}
		else{
			$this->assertSame($expected,'', 'Failure');
		}
    } 

    public function testValidatePasswordLogin() : void
	{
		$expected = "verified successfully.";
        $calc = new LoginClass();
        
		$result = $calc->ValidateAndAuthenticateLogin('test@gmail.com','Bcssdf027');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected,$result['success_msg']);
		}
		else{
			$this->assertSame($expected,'', 'Failure');
		}
    } 


	public function testValidateEmptyEmailAndPasswordLogin() : void
	{
		$expected = "verified successfully.";
        $calc = new LoginClass();
        
		$result = $calc->ValidateAndAuthenticateLogin('','');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected,$result['success_msg']);
		}
		else{
			$this->assertSame($expected,'', 'Failure');
		}
    } 

	public function testAuthenticateLogin() : void
	{
		$expected = "verified successfully.";
        $calc = new LoginClass();

		$result = $calc->ValidateAndAuthenticateLogin('alihassan87613@gmail.com','Bcsf12@027');
		if (isset($result) && array_key_exists("success_msg", $result))
		{

			$this->assertEquals($expected, $result['success_msg'] , "Success");
		}
		else{
			$this->assertEquals($expected,'');
		}
	}


	//Client profile Management 

	public function testFormSubmitProfile() {
		
		$expected = "verified successfully.";
		$profile = [];
		$profile['submit'] = 1;
		$profile['id'] = '1';
		$profile['FullName'] = 'Mike';
		$profile['Address1'] = 'GFD 14, St. Adams Mine';
		$profile['Address2'] = '';
		$profile['City'] = 'Mine';
		$profile['State'] = 'AL';
		$profile['ZipCode'] = '453246';

        $calc = new ClientProfileInformation;
		$result = $calc->form_submit($profile);
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertEquals($expected,'');
		}
	}

	public function testFormSubmitWithNotNewUserProfile() {
		
		$expected = "verified successfully.";
		$profile = [];
		$profile['submit'] = 0;
		$profile['id'] = '1';
		$profile['FullName'] = 'Mike';
		$profile['Address1'] = 'GFD 14, St. Adams Mine';
		$profile['Address2'] = '';
		$profile['City'] = 'Mine';
		$profile['State'] = 'AL';
		$profile['ZipCode'] = '453246';
        $calc = new ClientProfileInformation;
		$result = $calc->form_submit($profile);
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertEquals($expected,'');
		}
	}

	public function testCreateProfileCheckAllowEmptyFullNameTests() 
	{
		$expected = "Successfully updated your profile!";
		$calc = new ClientProfileInformation();
        $result = $calc->CreateClientProfile('1','','15G, St.Add 15, Mine, CA, USA', '', 'Mine', 'CA', '72345');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
	}


	public function testCreateProfileCheckAllowEmptyAddressTests() 
	{
		$expected = "Successfully updated your profile!";
		$calc = new ClientProfileInformation();
        $result = $calc->CreateClientProfile('1','Mike Hussey','', '', 'Mine', 'CA', '72345');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
	}

	public function testCreateProfileCheckAllowAddress2EmptyTests() 
	{
		$expected = "Successfully updated your profile!";
		$calc = new ClientProfileInformation();
        $result = $calc->CreateClientProfile('1','Mike Hussey','15G, St.Add 15, Mine, CA, USA', '', 'Mine', 'CA', '72345');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
	}

	public function testCreateProfileCheckAllowCityEmptyTests() 
	{
		$expected = "Successfully updated your profile!";
		$calc = new ClientProfileInformation();
        $result = $calc->CreateClientProfile('1','Mike Hussey','15G, St.Add 15, Mine, CA, USA', '', '', 'CA', '72345');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
	}

	public function testCreateProfileCheckAllowStateEmptyTests() 
	{
		$expected = "Successfully updated your profile!";
		$calc = new ClientProfileInformation();
        $result = $calc->CreateClientProfile('1','Mike Hussey','15G, St.Add 15, Mine, CA, USA', '', 'Mine', '', '72345');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
	}

	public function testCreateProfileCheckAllowZipcodeEmptyTests() 
	{
		$expected = "Successfully updated your profile!";
		$calc = new ClientProfileInformation();
        $result = $calc->CreateClientProfile('1','Mike Hussey','15G, St.Add 15, Mine, CA, USA', '', 'Mine', 'CA', '');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
	}

	public function testCreateProfileCheckFullNameLengthValidationTests() 
	{
		$expected = "Successfully updated your profile!";
		$calc = new ClientProfileInformation();
		$result = $calc->CreateClientProfile('1','jjkshfakfjhakflhasfhhujklfjbfkhjsfjhdfs jdfhsfiuhsfuhsd dfuhsfuishfus dsuifhsu','15G, St.Add 15, Mine, CA, USA', '', 'Mine', 'CA', '352344');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
	}

	public function testCreateProfileCheckAddress1LengthValidationTests() 
	{
		$expected = "Successfully updated your profile!";
		$calc = new ClientProfileInformation();
		$result = $calc->CreateClientProfile('1','jjkshf','15G, St.Add 15 akfjhakflhasfhhujklfjbfkhjsfjhdfs jdfhsfiuhsfuhsd dfuhsfuishfus dsuifhsudkjfsdljd kskjfhsk ljfhsk hfsklh sklhfsdkh sdkh sdkhf kdshf kjshdf kjshfk shlkfhskfh sklfhskjfhjdkshfj shdfjh dkfjshfjksfjk hsjfh sjfhj', 'Mine CA USA', '', 'Mine', 'CdfsA', '352344');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
	}

	public function testCreateProfileCheckEmptyValidationTests() 
	{
		$expected = "Successfully updated your profile!";
		$calc = new ClientProfileInformation();
		$result = $calc->CreateClientProfile('1', '','', '', '', '', '');
		if (isset($result) && array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
	}

	public function testCreateProfileTests() 
	{
	    //$userId, $FullName, $Address1, $Address2, $City, $State, $ZipCode
		$expected = "Successfully updated your profile!";

        $calc = new ClientProfileInformation;
        $result = $calc->CreateClientProfile( 1, 'Mike Hussey1' , '15G, St.Add 15, Mine, CA, USA' , '' , 'Mine' , 'CA' , '723456' );
		if ( array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
	}
	



	//Create Fuel Qoutes Test

	public function testFormSubmitFuelQoutes() {
		
		$expected = "verified successfully.";
		$fuelQoute = [];

		$fuelQoute['submitQoutes'] = 1;
		$fuelQoute['id'] = '1';
		$fuelQoute['Gallons'] = 'Mike';
		$fuelQoute['Delivery_Address'] = 'GFD 14, St. Adams Mine';
		$fuelQoute['Delivery_Date'] = '2020/01/05';
		$fuelQoute['Suggested_Price_Per_Gallon'] = 2.5 ;
		$fuelQoute['Total_Amount_Due'] = 2385;

        $calc = new FuelQoutes;
		$result = $calc->form_submit($fuelQoute);
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertEquals($expected,'');
		}
	}

	public function testCreateFuelQoutesValidationEmptyGallons() {

		//$Gallons, $Delivery_Address_C, $Delivery_Date, $Suggested_Price_Per_Gallon, $Total_Amount_Due
		$expected = "Successfully added fuel qoutes!";
		$calc = new FuelQoutes();
        $result = $calc->CreateFuelQoutes( 1, '', '15G, St.Add 15, Mine, CA, USA', '2021/01/05', -1, -1 );
		if (array_key_exists("success_msg", $result)) {
			$this->assertSame($expected, $result['success_msg']);
		}
		else {
			$this->assertSame($expected, '');
		}
	}

	public function testCreateFuelQoutesValidationDeliveryDate() 
	{
		//$Gallons, $Delivery_Address_C, $Delivery_Date, $Suggested_Price_Per_Gallon, $Total_Amount_Due
		$expected = "Successfully added fuel qoutes!";
		$calc = new FuelQoutes();
        $result = $calc->CreateFuelQoutes(1,  '500', '15G, St.Add 15, Mine, CA, USA', '', -1, -1 );
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
	}

	public function testCreateFuelQoutes() {

		//$Gallons, $Delivery_Address_C, $Delivery_Date, $Suggested_Price_Per_Gallon, $Total_Amount_Due
		$expected = "Successfully added fuel qoutes!";
        $calc = new FuelQoutes;
		$result = $calc->CreateFuelQoutes(1,  500, '15G, St.Add 15, Mine, CA, USA', '2021/01/05', 2.7, 3850 );
		if (array_key_exists("success_msg", $result))
		{
			$this->assertSame($expected, $result['success_msg']);
		}
		else{
			$this->assertSame($expected, '');
		}
    } 


	public function testFuelQoutesHistory() {

		//$Gallons, $Delivery_Address_C, $Delivery_Date, $Suggested_Price_Per_Gallon, $Total_Amount_Due
		$calc = new Fuel_Qoutes_History;
        $result = $calc->fetch_information();
		if (isset($result)) {
			$this->assertTrue(
				true,
				""
			);
		}
		else {
			$this->assertTrue(
				false,
				""
			);
		}
	}

	//Pricing Module 
	public function testGetFuelQoutes() 
	{
		//$Gallons, $Delivery_Address_C, $Delivery_Date, $Suggested_Price_Per_Gallon, $Total_Amount_Due
        $calc = new PricingModule;
		$result = $calc->Get_Qoutes(1500);
		if (isset($result))
		{
			$this->assertTrue(
				true,
				""
			);
		}
		else {
			$this->assertTrue(
				false,
				""
			);
		}
    } 

}