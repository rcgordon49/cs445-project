<?php
	$connection = mysql_connect("cs445sql", "rwstanle", "EL310rws");
	if (!$connection){
		die ("Couldn't connect to mysql server!<br>The error was: " . mysql_error());
	}
	else{
		echo "Connection successful!<br>\n";
	}
	if (!mysql_select_db("DGS"))
		die ("Couldn't select a database!<br> Error: " . mysql_error());
	else
		echo "Database selected successfully.<br>\n";
?>