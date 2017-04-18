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
			Remove the description of a staff member
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
	echo "<p><b>Time to remove a staff member's record!<b><p>";
	$Sno = '';
	}
	else{
		$Sno = mysql_real_escape_string($_POST['staffnum']);  
		
		$query = "DELETE FROM staff WHERE Sno = '$Sno';";

		$result_id = mysql_query ($query)  # issue query
			or die ("Cannot execute DELETE query");  # read & display results of query, then clean up
					
		$checkingquery = "select Sno from staff where Sno = '$Sno'";
		
		$result_id2 = mysql_query ($checkingquery)  # issue query
			or die ("Cannot execute query to delete staff member");
		
		if (mysql_num_rows($result_id2) == 0){   # checks to see if there are rows
			echo "<p><b>You successfully deleted this staff member<b><p>";  # message if not
			}
			else{
				echo ("<p><b>It did not work. This staff member is still in the database.<b><p>");
				}
				mysql_free_result ($result_id2); # makes some space
		}


html_end ();
?>

<p>
<input type="submit" name="Submit" value="Click to DELETE this staff member.">
</p>
<p>
Caution: Be sure you want to do this.
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