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
			Browse the description of staff members one at a time
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

if (empty($_GET)){   # check to see if a submission was made
echo "<p><b>Please select a staff number you would like to find details for.<b><p>";
}
else{
	$staffnum = $_GET['staffnum'];
	$query = "select Sno, LName, FName, Address,Tel_No, Position,Sex,DOB,Salary,NIN,Bno "
	. "from staff "
	. "where Sno = '$staffnum' "
	. "order by Lname";
	$result_id = mysql_query ($query)  # issue query
		or die ("Cannot execute query");  # read & display results of query, then clean up
		
		if (mysql_num_rows($result_id) == 0){   # checks to see if there are rows
			echo "<p><b>Sorry, There are no details listed for this staff number.<b><p>";  # message if not
		}else{
			echo ("<p><b>Here are the details listed for this Staff Number: <i>$staffnum</i>: <b><p>");

			while ($row = mysql_fetch_assoc($result_id))  # DATA_PRINT_LOOP
			{
			print ("<b>Last Name: </b>");
			printf ("%s<br>", $row['LName']);
			print ("<b>First Name: </b>");
			printf ("%s<br>", $row['FName']);
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
		}
		mysql_free_result ($result_id); # makes some space
}

echo '<form name="StaffChoose" method="get" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'; 
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
mysql_close (); #closes the connection

html_end ();
?>

<br>
<p>
<input type="submit" name="Submit" value="Show The Staff's Details for this Staff Number">
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