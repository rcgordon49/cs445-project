<?php
	if(isset($_GET['mid'])){
		$mid = mysql_real_escape_string($_GET['mid']);
		//echo "<script type='text/javascript'>alert('mid = $mid');</script>";
		session_start();
	  //REMOVE: $_SESSION['email'] = "testaddr@aol.com"
		if (isset($_SESSION['email']) && $_SESSION['email'] != '' && $_SESSION['email'] == "testaddr@aol.com"){
			$watchQuery = "INSERT INTO Watches (email_address, mid, watch_time) VALUES ('$_SESSION[email]', '$mid', NULL)";
			$watchResults = mysql_query(watchQuery);
			
			if(!empty($watchResults)){
				$success = "watch query successful";
			}
			else{
				$success = "watch query NOT successful";
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