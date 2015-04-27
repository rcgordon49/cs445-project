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


if(isset($status)){
	header("Location: admin.php?status=$status");
}


?>

<html>
<title>Admin Query Results Page</title>
<body>
<?php
while ($row = mysql_fetch_array($queryResults)){	
	for ($i = 0; $i < $numAttrs; $i++){
		echo "$row[$i]&emsp;";
	}
	echo "<br/>";
}


?>
</body>
</html>