<html><body>
<?php
	$search = $_POST['search'];
	$type = $_POST['query_type'];

	include("dbConnect.php");

	$query = "SELECT DISTINCT * FROM ";

	switch($type){
		case "title":
		case "year" :
			$query .= "Movies M WHERE M.".$type." ";
			break;
		case "professional":
			$query .=  "Professionals P WHERE P.pro_name ";
			break;
		case "genre":
			$query .= "Movies M, Has_Genre H WHERE M.mid = H.mid AND H.".$type." ";
			break;
		//work in progress
		case "users":
			$query .= "Users U WHERE U.name ";
			break;
	}

	$query .= "LIKE '" . $search . "%'";

	$result = mysql_query($query);
	if (!$result)
		echo "Query failed!";
	else{
		echo "Query successful.<br>\n";
		echo "Movies:<br>";
		//might use MYSQL_NUM in the future
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			foreach($row as $r):echo $r . "  ";
			endforeach;
			echo "<br>\n";
		}
	}
?>
</body></html>