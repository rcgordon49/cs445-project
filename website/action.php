<?php
	$search = $_POST['search'];
	$type = $_POST['query_type'];

	include("dbConnect.php");

	$query = "SELECT DISTINCT * FROM ";
	$href  = "";

	switch($type){
		case "title":
		case "year" :
			$query .= "Movies M WHERE M.".$type." ";
			$href = "movie.php";
			break;
		case "genre":
			$query .= "Movies M, Has_Genre H WHERE M.mid = H.mid AND H.".$type." ";
			$href = "movie.php";
			break;
		case "professional":
			$query .=  "Professionals P WHERE P.pro_name ";
			$href = "professional.php";
			break;
		//work in progress
		case "users":
			$query .= "Users U WHERE U.name ";
			$href = "user.php";
			break;
	}

	$query .= "LIKE '" . $search . "%'";
	$href .= "?";

	$result = mysql_query($query);
	if (!$result)
		echo "Query failed!";
	else{
		//might use MYSQL_NUM in the future
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			echo "<tr href=\"" . $href . $row[0] . "\">";
			foreach($row as $r):echo "<td>".$r."</td>";
			endforeach;
			echo "</tr>\n";
		}
	}
?>