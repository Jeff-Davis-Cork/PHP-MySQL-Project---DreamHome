<?php
#dreamconnect.php – common connection function
#Connect to the MySQL server using top-secret username & password
function dream_connect ()
{
$conn_id = @mysql_connect ("", "", "");
if ($conn_id && mysql_select_db ("Dreamhome_"))
	return ($conn_id);
return (FALSE);
}
function html_begin ($title, $header)
{
print ("<html>\n");
print ("<head>\n");
if ($title != "")
print ("<title>$title</title>\n");
print ("<head>\n");
if ($header != "")
print ("<h2>$title</h2>\n");
}
function html_end ()
{
print ("</body></html>\n");
}
?>

