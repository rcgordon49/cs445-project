<?php
session_start();
if(!session_is_registered(myemail)){
header("location:login.html");
}
?>

<html>
<body>
Login Successful
</body>
</html>