<?php
	$dbhost = 'hostname';
	$dbuser = 'username';
	$dbpass = 'password';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if(! $conn )
	{
	  die('Could not connect: ' . mysql_error());
	}
	
	if ( $_POST ) {
	//There is registration data to validate.
	//Check the form fields.
	//Input:
	// $contents: Contents of a field.
	//Returns:
	//  An error message, or an empty string if there was no error.
	function check_field($contents) {
		if ( $contents == '' ) {
		  return 'Do not leave blank.';
		}
	return '';
	}
	//Special check for country
	function check_country($contents) {
		if ( $contents != 'US' ) {
		  return 'Must be &#x201c;US&#x201d;.';
		}
	return '';
	}

	// escape variables for security
  
  	function check_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
  
  	//clean input
	$firstname = check_input($_POST['firstname']);
	$lastname = check_input($_POST['lastname']);
	$address1 = check_input($_POST['address1']);
	$address2 = check_input($_POST['address2']);
	$city = check_input($_POST['city']);
	$state = check_input($_POST['state']);
	$zip  = check_input($_POST['zip']);
	$country = check_input($_POST['country']);
  
	//Validate input.
	$error_message_firstname = check_field($firstname);
	$error_message_lastname = check_field($lastname);
	$error_message_address1 = check_field($address1);
	$error_message_city = check_field($city);
	$error_message_state = check_field($state);
	$error_message_zip = check_field($zip);
	$error_message_country = check_country($country);
	
	//Register and confirm if no errors.
	if ( $error_message_firstname == '' 
		&& $error_message_lastname == ''
		&& $error_message_address1 == ''
		&& $error_message_city == ''
		&& $error_message_state == ''
		&& $error_message_zip == ''
		&& $error_message_country == '') {
	$sql="INSERT INTO Users (Firstname, Lastname, Address1, Address2, City, State, Zip, Country, RegDate)
	VALUES ('$firstname', '$lastname', '$address1', '$address2', '$city', '$state', '$zip', '$country', NOW() )";


	mysql_select_db('database');
	mysql_query("SET time_zone = '-4:00';");
	$regval = mysql_query( $sql, $conn );

	if(! $regval )
	{
	  die('Could not enter data: ' . mysql_error());
	}

	mysql_close($conn);
	header("Location: confirm.php");
	exit();
	}
}?><!DOCTYPE HTML>
<html>
  <head>
    <title>User Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  	<div>
		<h1>User Registration</h1>
		<?php
		//Any error messages to display?
		if ( $error_message_firstname != '' ) {
		  print "<p class=\"warn\">First Name: $error_message_firstname</p>";
		}
		if ( $error_message_lastname != '' ) {
		  print "<p class=\"warn\">Last Name: $error_message_lastname</p>";
		}
		if ( $error_message_address1 != '' ) {
		  print "<p class=\"warn\">Address 1: $error_message_address1</p>";
		}
		if ( $error_message_city != '' ) {
		  print "<p class=\"warn\">City: $error_message_city</p>";
		}
		if ( $error_message_state != '' ) {
		  print "<p class=\"warn\">State: $error_message_state</p>";
		}
		if ( $error_message_zip != '' ) {
		  print "<p class=\"warn\">Zip: $error_message_zip</p>";
		}
		if ( $error_message_country != '' ) {
		  print "<p class=\"warn\">Country: $error_message_country</p>";
		}
		?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		  <p>
			First Name:
			<input type="text" name="firstname" placeholder="First Name" required
			<?php
			if ( $_POST['firstname'] ) {
			  print ' value="' . $_POST['firstname'] . '"';
			}
			?>
			> *
		  </p>
		  <p>
			Last Name:
			<input type="text" name="lastname" placeholder="Last Name" required
			<?php
			if ( $_POST['lastname'] ) {
			  print ' value="' . $_POST['lastname'] . '"';
			}
			?>
			> *
		  </p>
		  <p>
			Address 1:
			<input type="text" name="address1" placeholder="Address 1" required
			<?php
			if ( $_POST['address1'] ) {
			  print ' value="' . $_POST['address1'] . '"';
			}
			?>
			> *
		  </p>
		  <p>
			Address 2:
			<input type="text" name="address2" placeholder="Apartment/Suite" 
			<?php
			if ( $_POST['address2'] ) {
			  print ' value="' . $_POST['address2'] . '"';
			}
			?>
			> 
		  </p>
		  <p>
			City:
			<input type="text" name="city" placeholder="City" required
			<?php
			if ( $_POST['city'] ) {
			  print ' value="' . $_POST['city'] . '"';
			}
			?>
			> *
		  </p>
		  <p>
			State:
			<input type="text" name="state" placeholder="State" size =2 required
			<?php
			if ( $_POST['state'] ) {
			  print ' value="' . $_POST['state'] . '"';
			}
			?>
			> *
		  </p>
		  <p>
			Zip:
			<input type="text" name="zip" placeholder="Zip" size=10 required
			<?php
			if ( $_POST['zip'] ) {
			  print ' value="' . $_POST['zip'] . '"';
			}
			?>
			> *
		  </p>
		  <p>
			Country:
			<input type="text" name="country" size="2" value="US" placeholder="US" required 
			<?php
			if ( $_POST['country'] ) {
			  print ' value="' . $_POST['country'] . '"';
			}
			?>
			> *
		  </p>
		  <p>
			<em>Items marked &#x201c;*&#x201d; are required</em>
		  </p>
		  <p>
			<button type="submit">Register</button>
		  </p>
		</form>
    </div>
  </body>
</html>
