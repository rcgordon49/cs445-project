 <?PHP
 	session_start();
 	
    	if(isset($_GET['email']) & isset($_SESSION['email'])){
    	 	include("dbConnect.php");
    		$email=mysql_real_escape_string($_GET['email']);
    		
    		$existQuery = "SELECT * FROM Follows WHERE email1='$_SESSION[email]' AND email2='$email'";
    		$existResults = mysql_query($existQuery);
    		if(mysql_num_rows($existResults) > 0){
    			$query = "DELETE FROM Follows WHERE email1='$_SESSION[email]' AND email2='$email'";
    		}
    		else{
    		  $query = "INSERT INTO Follows(email1,email2,follow_time) VALUES ('$_SESSION[email]','$email',default)";
    		}
	    	$queryResults = mysql_query($query);
	    	header("Location: user.php?email=$email");

    	}
    	else{
    		echo "must be logged in and trying to follow user address";
    	}
?>