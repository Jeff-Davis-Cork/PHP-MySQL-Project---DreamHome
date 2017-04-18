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
			Change the salary of a staff member, specified by staff number
			</p>
		</nav>
    	<main>
<section>

<?php
include "dreamsetup.php"; # connect to db

dream_connect()
	or die("Cannot connect to server");
	
echo '<form name="StaffChoose" method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'; 
# define the form, clense for injection attack and self-process

print ("<b>Choose a Staff Identifier: </b>");
	
$staffquery = mysql_query ("select Sno from staff order by Sno")
	or die ("Cannot execute query");

if(mysql_num_rows($staffquery)){
$select= '<select name="staffnum">';
while($row=mysql_fetch_array($staffquery)){                               # while loop to list staff numbers
      $select.='<option value="'.$row['Sno'].'">'.$row['Sno'].'</option>';
  }
}

$select.='</select>';
echo $select;

mysql_free_result ($staffquery); # makes some space
 
####################################################################  - end of sno options...
if (empty($_POST)){   # check to see if a submission was made
	echo "<p><b>Time to update a staff member's Salary!<b><p>";
	$Salary = '';
	$Sno = '';
	}
	else{
		$Salary = mysql_real_escape_string($_POST['Salary']);
		$Sno = mysql_real_escape_string($_POST['staffnum']);  
		$fields = array('Salary');

		$error = false; # No errors yet
		foreach($fields AS $fieldname) { #Loop trough each field
			if(!isset($_POST[$fieldname]) ||  empty($_POST[$fieldname])) {   
			echo '<p>Sorry, It looks like you need to fill out the '.$fieldname.' box! Try Again.</p>'; #Display error with field
			$error = true; # a field is not filled out
			}
		}
if($error) { # Only create queries when no error occurs
  echo "<p><b>Please fill out the field to update the staff member's Salary. Try again<b><p>";
}
		else {
		$query = "UPDATE staff SET Salary = '$Salary' WHERE Sno = '$Sno';";

		$result_id = mysql_query ($query)  # issue query
			or die ("Cannot execute insert query");  # read & display results of query, then clean up
					
		$checkingquery = "select Sno, Salary from staff where Sno = '$Sno'";
		
		$result_id2 = mysql_query ($checkingquery)  # issue query
			or die ("Cannot execute query to update staff salary");
		
		if (mysql_num_rows($result_id2) == 0){   # checks to see if there are rows
			echo "<p><b>Sorry, There was a problem updating the salary. Please try again.<b><p>";  # message if not
			}
			else{
				echo ("<p><b>It worked ! You have updated the Salary.<b><p>");
				echo ("<p><b>Here is the new salary listed for this Staff Number: <i>$Sno</i>: <b><p>");
				while ($row = mysql_fetch_assoc($result_id2))  # DATA_PRINT_LOOP
				{
				print ("<b>Staff Number: </b>");
				printf ("%s<br>", $row['Sno']);
				print ("<b>Staff Salary: </b>");
				printf ("%s<br>", $row['Salary']);
				print ("<br><br>\n");
				}
				mysql_free_result ($result_id2); # makes some space
		}
}
}
echo ("<p>Enter in the new Salary for the selected staff number</p>");
echo '<form name="NewStaff" method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'; 
# define the form, clense for injection attack and self-process
echo ("<p>");
echo ("<b>Type a salary: </b><br>");
echo ("<input type='number' value='$Salary' name='Salary' min='1000' max='500000' ><br>");
echo ("</p>");

html_end ();
?>

<br>
<p>
<input type="submit" name="Submit" value="Enter in the new address.">
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