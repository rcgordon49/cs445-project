<?php
session_start();
if(!session_is_registered(myusername)){
header("location:login");
}
?>

<html>
<body>
Login Successful
</body>
</html>