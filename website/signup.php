<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

	<head>
		<title>Sign Up</title>
	</head>

	<body>

	<script type = "javascript">
		$(window).load(function(){
			<?php
					if(isset($_GET['error'])){
						echo 'alert("$_GET[error]")';
					}
			?>
		});


	</script>

	<div align="center">

		<font size="7">Sign Up</font>

	<form action="signupAction.php" method="post">

	 	<p><input placeholder="Email" type="text" name="email" id="email" required/></p>
	 	<p><input placeholder="Password" type="password" name="password" id="password" required/></p>
	 	<p><input placeholder = "Confirm Password" type="password" name="confirmpassword" id="confirmpassword" required/></p>
	 	<p><input placeholder = "Name" type="text" name="name" id="name"/></p>
	 	<p><input placeholder = "Location" type="text" name="location" id="location"/></p>
	 	<p><input placeholder = "Age" type="text" name="age" id="age"/></p>
	 	<p><input placeholder = "Gender" type="text" name="gender" id="gender"/></p>
	 	
    	<input type="submit" value="Sign Up">
		

	</form>
	</div>

	</body>
</html>