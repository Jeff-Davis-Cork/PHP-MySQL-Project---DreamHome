<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>The DreamHome WebSite !</title>
		<link rel="shortcut icon" href="smile.gif" type="image/gif">
		<link rel="icon" href="smile.gif" type="image/gif">
		<link href="dreamhome_style.css" rel="stylesheet">
		<meta name="viewport" content="initial-scale=1.0, width=device-width" />
    </head>
	<body>
		<nav>
			<ul>
				<li><a href="http://cs1.ucc.ie/~jd23/staff.html">Staff Operations</a></li>
				<li><a href="http://cs1.ucc.ie/~jd23/branch.html">Branch Operations</a></li>
				<li><a href="http://cs1.ucc.ie/~jd23/property.html">Property Operations</a></li>
				<li><a href="http://cs1.ucc.ie/~jd23/dreamhome.html"><i>Main Site</i></a></li>
			</ul>
			<p>
			The DreamHome Site - Staff Operations
			</p>
			<p>
			Record the details of a new staff member
			</p>
		</nav>
    	<main>
<section>

<?php

include "dreamsetup.php"; # connect to db
# $title="Welcome to the Dreamhome Website"; - not needed as using main page html
# html_begin($title,$title);

dream_connect()
	or die("Cannot connect to server");
		
if (empty($_POST)){   # check to see if a submission was made
	echo "<p><b>Time for some new staff !<b><p>";
	$Sno = '';
	$Lname = '';
	$Fname = '';
	$Address = '';
	$Tel_No = '';
	$Position = '';
	$DOB = '';
	$Sex = '';
	$Salary = '';
	$NIN = '';
	$Bno = '';
	}
	else{
		$Sno = mysql_real_escape_string($_POST['Sno']);  # mysql_real_escape_string prevents MySql injections..
		$Lname = mysql_real_escape_string($_POST['Lname']);
		$Fname = mysql_real_escape_string($_POST['Fname']);
		$Address = mysql_real_escape_string($_POST['Address']);
		$Tel_No = mysql_real_escape_string($_POST['Tel_No']);
		$Position = mysql_real_escape_string($_POST['Position']);
		$DOB = mysql_real_escape_string($_POST['DOB']);
		$Sex = mysql_real_escape_string($_POST['Sex']);
		$Salary = mysql_real_escape_string($_POST['Salary']);
		$NIN = mysql_real_escape_string($_POST['NIN']);
		$Bno = mysql_real_escape_string($_POST['Bno']);
		
		$fields = array('Sno', 'Lname', 'Fname', 'Address', 'Tel_No', 'Position', 'DOB', 'Sex', 'Salary', 'NIN','Bno');

		$error = false; # No errors yet
		foreach($fields AS $fieldname) { #Loop trough each field
			if(!isset($_POST[$fieldname]) ||  empty($_POST[$fieldname])) {   
			echo 'Sorry, It looks like you need to fill out the '.$fieldname.' box! Try Again.<br />'; #Display error with field
			$error = true; # a field is not filled out
			}
		}
if($error) { # Only create queries when no error occurs
  echo "<p><b>Please fill out all the fields to create a new staff member. Try again<b><p>";
}
		else {
		$query = "INSERT INTO staff (Sno, Lname, Fname, Address,Tel_No,Position,DOB,Sex,Salary,NIN,Bno) VALUES ('$Sno', '$Lname', '$Fname', '$Address','$Tel_No','$Position','$DOB','$Sex','$Salary','$NIN','$Bno')";

		$result_id = mysql_query ($query)  # issue query
			or die ("Cannot execute insert query");  # read & display results of query, then clean up
					
		$checkingquery = "select Sno, Lname, Fname, Address,Tel_No,Position,DOB,Sex,Salary,NIN,Bno from staff where Sno = '$Sno'";
		
		$result_id2 = mysql_query ($checkingquery)  # issue query
			or die ("Cannot execute query to check the new staff member");
		
		if (mysql_num_rows($result_id2) == 0){   # checks to see if there are rows
			echo "<p><b>Sorry, There was a problem creating a new employee record. Please try again.<b><p>";  # message if not
			}
			else{
				echo ("<p><b>It worked ! You have added a new staff member to the database.<b><p>");
				echo ("<p><b>Here are the details listed for this Staff Number: <i>$Sno</i>: <b><p>");
				while ($row = mysql_fetch_assoc($result_id2))  # DATA_PRINT_LOOP
				{
				print ("<b>Staff Number: </b>");
				printf ("%s<br>", $row['Sno']);
				print ("<b>Last Name: </b>");
				printf ("%s<br>", $row['Lname']);
				print ("<b>First Name: </b>");
				printf ("%s<br>", $row['Fname']);
				print ("<b>Staff Address: </b>");
				printf ("%s<br>", $row['Address']);
				print ("<b>Telephone Number: </b>");
				printf ("%s<br>", $row['Tel_No']);
				print ("<b>Position: </b>");
				printf ("%s<br>", $row['Position']);
				print ("<b>Sex: </b>");
				printf ("%s<br>", $row['Sex']);
				print ("<b>Date of Birth: </b>");
				printf ("%s<br>", $row['DOB']);
				print ("<b>Salary: </b>");
				printf ("%s<br>", $row['Salary']);
				print ("<b>NIN: </b>");
				printf ("%s<br>", $row['NIN']);
				print ("<b>Branch Number: </b>");
				printf ("%s<br>", $row['Bno']);
				print ("<br><br>\n");
				}
				mysql_free_result ($result_id2); # makes some space
		}
}
}
echo ("<p>Enter in the details for a new staff member</p>");
echo '<form name="NewStaff" method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'; 
# define the form, clense for injection attack and self-process
echo ("<p>");
echo ("<b>Type a Staff Number:</b><br>");
echo ("<input type='text' value='$Sno' name='Sno' maxlength='4'><br>");
echo ("</p>");
echo ("<p>");
echo ("<b>Type a Last Name:</b><br>");
echo ("<input type='text' value='$Lname 'name='Lname' maxlength='15'><br>");
echo ("</p>");
echo ("<p>");
echo ("<b>Type a First Name:</b><br>");
echo ("<input type='text' value='$Fname'name='Fname' maxlength='15'><br>");
echo ("</p>");
echo ("<p>");
echo ("<b>Type an Address:</b><br>");
echo ("<input type='text' value='$Address' name='Address' maxlength='35'><br>");
echo ("</p>");
echo ("<p>");
echo ("<b>Type a phone number:</b><br>");
echo ("<input type='text' value='$Tel_No' name='Tel_No' maxlength='15'><br>");
echo ("</p>");
echo ("<p>");
echo ("<b>Type a position:</b><br>");
echo ("<input type='text' value='$Position' name='Position' maxlength='15'><br>");
#echo ("<b>Select a position:</b><br>");
#echo ("<select name='Position' form='NewStaff'>");
#echo ("<option value='Manager'>Manager</option>");
#echo ("<option value='Assistant'>Assistant</option>");
#echo ("<option value='Deputy Assistant'>Deputy Assistant</option>");
#echo ("<option value='Snr Asst'>Snr Asst</option>");
#echo ("</select>");
echo ("</p>");
echo ("<p>");
echo ("<b>Choose a Date of Birth:</b><br>");
echo ("<input type='date' name='DOB'><br>");
echo ("</p>");
echo ("<p>");
echo ("<b>Click on a Gender:</b><br>");
echo (" <input type='radio' name='Sex' value='M' checked> Male<br>");
echo (" <input type='radio' name='Sex' value='F'> Female<br>");
echo ("</p>");
echo ("<p>");
echo ("<b>Type a salary: </b><br>");
echo ("<input type='number' value='$Salary' name='Salary' min='1000' max='500000' ><br>");
echo ("</p>");
echo ("<p>");
echo ("<b>Type a NIN: </b><br>");
echo ("<input type='text' value='$NIN' name='NIN' ><br>");
echo ("</p>");
echo ("<p>");
echo ("<b>Type a branch number:</b><br>");
echo ("<input type='text' value='$Bno' name='Bno' maxlength='2'><br>");
#echo ("<b>Select a Branch:</b><br>");
#echo ("<select name='Bno' form='NewStaff'>");
#echo ("<option value='B2'>B2</option>");
#echo ("<option value='B3'>B3</option>");
#echo ("<option value='B4'>B4</option>");
#echo ("<option value='B5'>B5</option>");
#echo ("<option value='B7'>B7</option>");
#echo ("</select>");
echo ("</p>");

html_end ();
?>

<br>
<p>
<input type="submit" name="Submit" value="Enter in these new staff details.">
</p>
</form>
</section>
		</main>
		<footer>
			<p> 
				<small>
					&copy; Jeff Davis, Student, Department of Computer Science, University College Cork. All rights reserved.
				</small>
			</p> 
			<p>
				<small>
					Contact information: 116221322 at umail dot ucc dot ie
				</small>
			</p>
			<p>
				<small>
					<a href="http://cs1.ucc.ie/~jd23/disclaimer.html">Legal disclaimer</a>
				</small>
			</p> 
		</footer>
	</body>
</html>