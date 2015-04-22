<?php
	// Connect to server and select databse.
	include("dbConnect.php");

	// username and password sent from form 
	$myemail=$_POST['myemail']; 
	$mypassword=$_POST['mypassword']; 

	// To protect MySQL injection
	$myemail = stripslashes($myemail);
	$mypassword = stripslashes($mypassword);
	$myemail = mysql_real_escape_string($myemail);
	$mypassword = mysql_real_escape_string($mypassword);
	$query="SELECT * FROM Users WHERE email='$myemail' and password='$mypassword'";
	$result=mysql_query($query);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $myemail and $mypassword, table row must be 1 row
	if($count==1){

	// Register $myemail, $mypassword and redirect to file "login_success.php"
		session_register("myemail");
		session_register("mypassword"); 
		header("location:login_success.php");
	}
	else {
		echo "Wrong Username or Password";
		echo $myemail;
		echo $mypassword;
		echo $result;
	}
?>

<html>
<body>
</body>
</html>