<html><body>
<?php
	$title = $_POST['title'];

	echo $title;

	include("dbConnect.php");

	$query = "SELECT DISTINCT M.mid, M.title, M.year FROM Movies M WHERE M.title LIKE '" . $title . "%'";
	$result = mysql_query($query);
	if (!$result)
		echo "Query failed!";
	else{
		echo "Query successful.<br>\n";
		echo "Movies:<br>";
		while ($row = mysql_fetch_array($result)){
			echo "mid: $row[0], title: $row[1], year: $row[2]<br>\n";
		}
	}
?>
</body></html>