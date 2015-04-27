<?php
session_start();

//restricts access to only the admin
//CHANGE: address to admin one
if (!isset($_SESSION['email']) || $_SESSION['email'] != "testaddr@aol.com"){
	header('HTTP/1.0 404 Not Found');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
		<title>Admin Page</title>
		<meta charset="utf-8">
    
    <!-- bootstrap libraryies: -->
    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 		
</head>
<body>
<h4 align="center">Admin Center</h4>
<form id="queryForm" action="adminAction.php" method="post" align = "center">
<textarea name="sqlQuery" id="sqlQuery" form="queryForm" style="width: 300px; height:150px;">Enter MySQL Query...</textarea>
<br/>
<input type="submit" name="querySubmit" value="Submit Query" onclick="return confirm('Are you sure you want to submit this query?')">
</form>

<br/>
<br/>
<?php
if(isset($_GET['status'])){
	$status = $_GET['status'];
	echo "<div align=\"center\" >Query Error Message:&emsp;$status</div>";
}
?>
</body>
</html>
 