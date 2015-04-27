<html>
<head>
	<title>My cool website</title>
</head>

<body>	
	<?php include("import.php"); ?>
	<div align = "right">
		<form action="http://cs445.cs.umass.edu/php-wrapper/cs445_DGS_s15/login.html" align="right">
    		<input type="submit" value="Sign In">
		</form>
	</div>

	<!Main title for website>
	<div align = "center" id="header">
		<!img src="templates\logo.png" alt="Cool Website Logo" />
		<p style="font-size: 200%;" >MovieNet</p>
	</div>

	<div align = "center" >
  		<?php
  			include("bar.php");
  		?>
	<div/>
</body>
</html>