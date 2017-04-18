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
			The DreamHome Site - Branch Operations
			</p>
			<p>
			Find the address of the staff members in a branch
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
echo "<p><b>Please select a Branch Number you would like to find the staff address for.<b><p>";
}
else{
	$branchnum = $_GET['branchnum'];
	$query = "select distinct s.address from staff as s join branch as b on b.Bno=s.Bno where s.Bno = '$branchnum'";
	
	$result_id = mysql_query ($query)  # issue query
		or die ("Cannot execute query");  # read & display results of query, then clean up
		
		if (mysql_num_rows($result_id) == 0){   # checks to see if there are rows
			echo "<p><b>Sorry, There is no staff address listed for this branch number.<b><p>";  # message if not
		}else{
			echo ("<p><b>Here is the staff address(s) listed for the selected Branch Number: <i>$branchnum</i>: <b><p>");

			while ($row = mysql_fetch_assoc($result_id))  # DATA_PRINT_LOOP
			{
			print ("<b>Address: </b>");
			printf ("%s<br>", $row['address']);
			print ("<br><br>\n");
			}
		}
		mysql_free_result ($result_id); # makes some space
}

echo '<form name="StaffChoose" method="get" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'; 
# define the form, clense for injection attack and self-process

print ("<b>Choose a Branch Number: </b>");
	
$staffquery = mysql_query ("select Bno from branch order by Bno")
	or die ("Cannot execute query");

if(mysql_num_rows($staffquery)){
$select= '<select name="branchnum">';
while($row=mysql_fetch_array($staffquery)){                               # while loop to list staff numbers
      $select.='<option value="'.$row['Bno'].'">Branch Number: '.$row['Bno'].' </option>';
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
<input type="submit" name="Submit" value="Show the address of the staff members in this branch">
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