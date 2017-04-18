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
			The DreamHome Site - Property Operations 
			</p>
			<p>
			Find the street name & property type for a given property number
			</p>
		</nav>
    	<main>
<section>

<?php

include "dreamsetup.php"; # connect to db

dream_connect()
	or die("Cannot connect to server");

if (empty($_GET)){   # check to see if a submission was made
echo "<p><b>Please select a property number you would like to find a street name & type for.<b><p>";
}
else{
	$Pno = $_GET['Pno'];
	$query = "select Street, Type "
	. "from property_for_rent "
	. "where Pno = '$Pno' "
	. "order by Pno";
	$result_id = mysql_query ($query)  # issue query
		or die ("Cannot execute query");  # read & display results of query, then clean up
		
		if (mysql_num_rows($result_id) == 0){   # checks to see if there are rows
			echo "<p><b>Sorry, There is no street name and type listed for this property number.<b><p>";  # message if not
		}else{
			echo ("<p><b>Here is the street name and type</p><p> listed for this property number: <i>$Pno</i>: <b><p>");

			while ($row = mysql_fetch_assoc ($result_id))  # DATA_PRINT_LOOP
			{
			print ("<b>Street Name: </b>");
			printf ("%s<br>", $row['Street']);
			print ("<b>Type: </b>");
			printf ("%s<br>", $row['Type']);
			print ("<br><br>\n");
			}
		}
		mysql_free_result ($result_id); # makes some space
}

echo '<form name="StaffChoose" method="get" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'; 
# define the form, clense for injection attack and self-process

print ("<b>Choose a property number: </b>");
	
$staffquery = mysql_query ("select distinct Pno from property_for_rent order by Pno")
	or exit ();

if(mysql_num_rows($staffquery)){
$select= '<select name="Pno">';
while($row=mysql_fetch_array($staffquery)){                               # while loop to list staff numbers
      $select.='<option value="'.$row['Pno'].'">'.$row['Pno'].'</option>';
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
<input type="submit" name="Submit" value="Show The Street Name and Type for this Property">
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