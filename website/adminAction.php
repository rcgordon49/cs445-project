<?php
session_start();

//restricts access to only the admin
//CHANGE: address to admin one
if (!isset($_SESSION['email']) || $_SESSION['email'] != "testaddr@aol.com"){
	header('HTTP/1.0 404 Not Found');
	exit;
}

if($_POST && isset($_POST['sqlQuery'])) {
	include("dbConnect.php");
	//die(var_dump($_POST));
	$query = $_POST['sqlQuery'];
	$queryString = mysql_escape_string($query);
	$queryResults = mysql_query($query);
	$resultCount = mysql_num_rows($queryResults);
	$numAttrs = mysql_num_fields($queryResults);
	
	if($resultCount == 0){
		$status = mysql_error();
	}

}
else{
	$status = "No query submitted.";
}


?>

<html>
<title>Admin Query Results Page</title>
<body>
<br/>
<h4>Query:</h4>
<p><?php echo "$query"; ?></p>
<h4>Query Results</h4>
<button onclick="location.href = 'admin.php';" id="returnButton" class="submit">Return to Query Page</button>
<br/><br/><br/>
<?php
if(isset($status)){
	//header("Location: admin.php?status=$status");
	echo "ERROR: $status";
}else{
	echo "Number of Rows Returned: $resultCount<br/><table border='1' style='width:75%'><tr>";
	for ($i=0; $i < $numAttrs; $i++){
		$field = mysql_fetch_field($queryResults, $i);
		echo "<td>$field->name</td>";
	}
	echo "</tr>";
	while ($row = mysql_fetch_array($queryResults)){	
		echo "<tr>";
		for ($i = 0; $i < $numAttrs; $i++){
			echo "<td>$row[$i]</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}


?>
</body>
</html>