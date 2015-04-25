<?php
$email = $_GET['email'];

session_start();
if(!session_is_registered(myemail)){
	header("location:login.html");
}else{
	header("Location:user.php?email=".urlencode($email));
}
?>

<html>
<body>
Login Successful
</body>
</html>