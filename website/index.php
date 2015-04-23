<html>
<head>
	<title>My cool website</title>
</head>
<body>	
	<div align = "right">
		<button align="right" type="button">Sign In</button>
	</div>
	<!Main title for website>
	<div align = "center" id="header">
		<!img src="templates\logo.png" alt="Cool Website Logo" />
		<p style="font-size: 200%;" >MovieNet</p>
	</div>



	<div align = "center" >
		<form method="POST" action="action.php">
			<input type="text" size="48" name="search"></label>

			<select name = "query_type" id="query_type">
				<option value="title">Title</option>
				<option value="professional">Professional</option>
				<option value="genre">Genre</option>
				<option value="year">Year</option>
				<option value = "user">User</option>
			</select>

			<input type="submit" value="Search" align="right">
		</form>
	<div/>
</body>
</html>