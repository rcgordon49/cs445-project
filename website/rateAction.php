<?PHP
	if($_POST && isset($_POST['rating']) && isset($_POST['mid'])) {
		if (empty($_POST["rating"]) || empty($_POST["mid"])) {
			$rating = -1;
		} else {
    	$rating = mysql_real_escape_string($_POST["rating"]);
    	$mid = mysql_real_escape_string($_POST["mid"]);
    	
    	session_start();
    	//REMOVE: $_SESSION['email'] = "testaddr@aol.com"
    	if (isset($_SESSION['email'])){
    	  include("dbConnect.php");
    	  $rateQuery = "INSERT INTO Rates(email_address, mid, user_rating) 
    	  							VALUES ('$_SESSION[email]', '$mid', '$rating')
    	  							ON DUPLICATE KEY UPDATE
    	  							user_rating = VALUES(user_rating)";
    	  $rateResults=mysql_query($rateQuery);

    	  $avgInfoQuery = "SELECT DISTINCT M.mid, M.title, M.year, 
    	  						 	count(R.user_rating) AS num_rates, avg(R.user_rating) AS avg_rating,
    	  						 	avg(U.age) AS avg_user_age
    	  						 FROM Movies M, Rates R, Users U
    	  						 WHERE R.mid='$mid' AND R.mid=M.mid AND R.email_address = U.email_address";
    	  $avgInfoResults=mysql_query($avgInfoQuery);
    	  $row = mysql_fetch_array($avgInfoResults);
    	  
    	  //updates the averages and totals if the movie was already rated, else puts in a new row
    	  //failed attempt at concise query:
    	  $avgUpdateQuery = "INSERT INTO Avg_Ratings (mid, title, year, num_rates, avg_rating, avg_user_age)
    	  									 VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]')
    	  									 ON DUPLICATE KEY UPDATE
    	  									 num_rates = VALUES(num_rates),
    	  									 avg_rating = VALUES(avg_rating),
    	  									 avg_user_age = VALUES(avg_user_age)";
    	  
    	  /*
    	  $existQuery = "SELECT * FROM Avg_Ratings WHERE mid='$mid'";
    	  $existResults = mysql_query($existQuery);
    	  if (mysql_num_rows($existResults) > 0){
    	  	$avgUpdateQuery = "UPDATE Avg_Ratings
    	  										 SET num_rates='$row[3]', avg_rating='$row[4]', avg_user_age='$row[5]'
    	  										 WHERE mid='$mid'";
    	  }
    	  else{
    	  	$avgUpdateQuery = "INSERT INTO Avg_Ratings (mid, title, year, num_rates, avg_rating, avg_user_age)
    	  									 	 VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]')";
    	  }
    	  */
    	  $avgUpdateResults=mysql_query($avgUpdateQuery);
    	  
    	}
  	}
	}
	if(!empty($rateResults) && !empty($avgInfoResults) && !empty($avgUpdateResults)){
		$success = "rate query successful";
	}
	else{
		$err = mysql_error();
		$success = "rate query NOT successful -- $err";
	}
	header("Location: movie.php?rating=$rating&mid=$mid&success=$success"); //remove query param when DBMS insertion is live
?>