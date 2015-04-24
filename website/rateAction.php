<?PHP
	if($_POST && isset($_POST['rating'])) {
		if (empty($_POST["rating"])) {
			$rating = -1;
		} else {
    	$rating = $_POST["rating"];
  	}
	}
	header("Location: movie.php?rating=$rating");
?>