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
			Find the staff number, last name and first name of those earning more/less than a given salary
			</p>
		</nav>
    	<main>
<section>

<?php

include "dreamsetup.php"; # connect to db

dream_connect()
	or die("Cannot connect to server");

if (empty($_GET)){   # check to see if a submission was made
echo "<p><b>Find the staff number, last name and first name of those earning more/less than a given salary.<b><p>";
echo "<p><b>Please type in a minimum and maximum salary you would like to search between.<b><p>";
}
else{
	$salary_max = $_GET['salary_max'];
	$salary_min = $_GET['salary_min'];
	if ($salary_max>=1000 && $salary_max<=500000 && $salary_min>=1000 && $salary_min<=500000){
		$query = "select Salary, Sno, Lname, Fname "
		. "from staff "
		. "where Salary >= '$salary_min' "
		. "and Salary <= '$salary_max' "
		. "order by Lname";
		$result_id = mysql_query ($query)  # issue query
			or die ("Cannot execute query");  # read & display results of query, then clean up
			
			if (mysql_num_rows($result_id) == 0){   # checks to see if there are rows
				echo "<p><b>Sorry, There is no address and phone listed for this last name.<b><p>";  # message if not
			}else{
				echo ("<p><b>Here is the staff number, last name and first name of those earning more than <i>$salary_min</i> and less than <i>$salary_max</i>: <b><p>");

				while ($row = mysql_fetch_assoc ($result_id))  # DATA_PRINT_LOOP
				{
				print ("<b>Last Name: </b>");
				printf ("%s<br>", $row['Lname']);
				print ("<b>First Name: </b>");
				printf ("%s<br>", $row['Fname']);
				print ("<b>Staff Number: </b>");
				printf ("%s<br>", $row['Sno']);
				print ("<b>Salary: </b>");
				printf ("%s<br>", $row['Salary']);
				print ("<br><br>\n");
				}
			}
			mysql_free_result ($result_id); # makes some space
			}
	else {
		echo ("<p><b>One of your values was not between 1000 and 500000. Please try again</b></p>");
	}
}
echo ("<p>Enter numbers between 1000 and 500000</p>");
echo '<form name="MinSalary" method="get" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'; 
# define the form, clense for injection attack and self-process
echo ("<p>");
echo ("<b>Type a minimum salary:</b><br>");
echo ("<input type='text' name='salary_min' <br>");
echo ("</p>");
echo ("<p>");
echo ("<b>Type a maximum salary: </b><br>");
echo ("<input type='text' name='salary_max' <br>");
echo ("</p>");

html_end ();
?>

<br>
<p>
<input type="submit" name="Submit" value="Show the staff number, last name and first name for this salary range">
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