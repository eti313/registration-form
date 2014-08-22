<!DOCTYPE HTML>
<html>
<head>
	<title>Admin Report</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div>
    <h1>Registered Users</h1>
      <?php
      $con=mysqli_connect("hostname","username","password","database");
      //check connection to database
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      $sql = "SELECT * FROM `Users` ORDER BY RegDate DESC ";
      $result = mysqli_query($con,$sql) or die ("Unable to select: ".mysql_error());
      print "<table id=\"rt1\" class=\"rt cf\">\n
      		<thead class=\"cf\">
      			<tr>
      			 	<th>First Name</th>
      			 	<th>Last Name</th>
      			 	<th>Address1</th>
      			 	<th>Address2</th>
      			 	<th>City</th>
      			 	<th>State</th>
      			 	<th>Zip</th>
      			 	<th>Country</th>
      			 	<th>Date</th>
      			</tr>
      		</thead>";
      while($row = mysqli_fetch_array($result)) {
        echo
  "	<tr>
	  <td>" . $row['FirstName'] . "</td>
	  <td>" . $row['LastName']  . "</td>
	  <td>" . $row['Address1']  . "</td>
	  <td>" . $row['Address2']  . "</td>
	  <td>" . $row['City']      . "</td>
	  <td>" . $row['State']     . "</td>
	  <td>" . $row['Zip']       . "</td>
	  <td>" . $row['Country']   . "</td>
	  <td>" . $row['RegDate']   . "</td>
	</tr>\n";
      }
      echo "      </table>\n";
      mysqli_close($con);
      ?>
  </div>
</body>
</html>
