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
?>