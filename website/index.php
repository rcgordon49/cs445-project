<?PHP
	$query_type = $_POST['query_type'];

  // form handler
  if($_POST && isset($_POST['search'], $_POST['query'])) {
	switch($query_type){
		case 'Title':
    		$query = $_POST['query']; exit;
		case 'Actor':
			exit;
		case 'Genre':
			exit;
		case 'Year':
			exit;
	}
  }

?>

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

<?PHP
  if(isset($query) && $query) {
    echo "<p style=\"color: red;\">*",htmlspecialchars($query),"</p>\n\n";
  }
?>
	<form method="POST" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" accept-charset="UTF-8">
		<input type="text" size="48" name="title" value="<?PHP if(isset($_POST['query'])) echo htmlspecialchars($_POST['query']); ?>"></label>
		
		<select name = "query_type" id="query_type">
  			<option value="title">Title</option>
  			<option value="actor">Actor</option>
  			<option value="genre">Genre</option>
  			<option value="year">Year</option>
			<option value = "user">User</option>
		</select>
		
		<input type="submit" name="search" value="search" align="right">
		
	</form>
	

	

<div/>

     <div id="content">
</body>
</html>