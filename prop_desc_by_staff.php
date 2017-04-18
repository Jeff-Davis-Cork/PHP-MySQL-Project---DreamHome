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
			Find the description of properties administered by a given staff member
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
echo "<p><b>Please select a staff member you would like to find a branch address for.<b><p>";
}
else{
	$staffnum = $_GET['staffnum'];
	$query = " select p.Pno,p.Street,p.Area,p.City,p.Pcode,p.Type,p.Rooms,p.Rent,p.Ono,p.Bno from property_for_rent as p join staff as s on p.Bno=s.Bno where s.Sno = '$staffnum'";
	
	$result_id = mysql_query ($query)  # issue query
		or die ("Cannot execute query");  # read & display results of query, then clean up
		
		if (mysql_num_rows($result_id) == 0){   # checks to see if there are rows
			echo "<p><b>Sorry, There is no property description listed for this staff number.<b><p>";  # message if not
		}else{
			echo ("<p><b>Here are the property details listed for the selected Staff Number: <i>$staffnum</i>: <b><p>");

			while ($row = mysql_fetch_assoc($result_id))  # DATA_PRINT_LOOP
			{
			print ("<b>Property Number: </b>");
			printf ("%s<br>", $row['Pno']);
			print ("<b>Street: </b>");
			printf ("%s<br>", $row['Street']);
			print ("<b>Area: </b>");
			printf ("%s<br>", $row['Area']);
			print ("<b>City: </b>");
			printf ("%s<br>", $row['City']);
			print ("<b>Postal Code: </b>");
			printf ("%s<br>", $row['Pcode']);
			print ("<b>Property Type: </b>");
			printf ("%s<br>", $row['Type']);
			print ("<b>Number of Rooms: </b>");
			printf ("%s<br>", $row['Rooms']);
			print ("<b>Rent: </b>");
			printf ("%s<br>", $row['Rent']);
			print ("<b>Owner Number: </b>");
			printf ("%s<br>", $row['Ono']);
			print ("<b>Branch Number: </b>");
			printf ("%s<br>", $row['Bno']);
			print ("<br><br>\n");
			}
		}
		mysql_free_result ($result_id); # makes some space
}

echo '<form name="StaffChoose" method="get" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'; 
# define the form, clense for injection attack and self-process

print ("<b>Choose a Staff Member: </b>");
	
$staffquery = mysql_query ("select Sno, Lname, Fname from staff order by Sno")
	or die ("Cannot execute query");

if(mysql_num_rows($staffquery)){
$select= '<select name="staffnum">';
while($row=mysql_fetch_array($staffquery)){                               # while loop to list staff numbers
      $select.='<option value="'.$row['Sno'].'">Staff Number:'.$row['Sno'].'  Last Name:'.$row['Lname'].'  First Name:'.$row['Fname'].' </option>';
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
<input type="submit" name="Submit" value="Show each of the property details for this staff member">
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