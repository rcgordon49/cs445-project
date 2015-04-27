<?php
	if(isset($_GET['mid'])){
		$mid = mysql_real_escape_string($_GET['mid']);
		//echo "<script type='text/javascript'>alert('mid = $mid');</script>";
		session_start();
	  //REMOVE: $_SESSION['email'] = "testaddr@aol.com"
		if (isset($_SESSION['email'])){
			include("dbConnect.php");
			$watchQuery = "INSERT INTO Watches(email_address, mid, watch_time) VALUES ('$_SESSION[email]', '$mid', DEFAULT)";
			$watchResults = mysql_query($watchQuery);
			
			if(!empty($watchResults)){
				$success = "watch query successful";
			}
			else{
				$err = mysql_error();
				$success = "watch query NOT successful -- $err";
			}
		}
		else{
			$success = "watch query -- logon needed";
		}
	}
	else{
		$success = "watch query -- mid needed";
	}
	
	
	header("Location: movie.php?mid=$mid&success=$success");

?>