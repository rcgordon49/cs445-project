<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?PHP
	include("dbConnect.php");
	session_start();

	if(isset($_GET['email'])){
	  	$email = $_GET['email'];
	  	$followUrl = "followAction.php?email=$email";

	  	$user_info_query = "SELECT * FROM Users U WHERE U.email_address = '$email'";

	  	$user_results = mysql_query($user_info_query);

	  	$row = mysql_fetch_array($user_results);
	  	$name =  $row[1];

	  	$watchQuery="SELECT U.name, W.email_address, W.mid, W.watch_time, M.title 
	  	FROM Movies M, Watches W, Users U, Follows F 
	  	WHERE M.mid = W.mid AND W.email_address = F.email2 AND U.email_address = W.email_address AND F.email1 = '$email'
	  	ORDER BY watch_time DESC";

	  	$ratedQuery ="SELECT U.name, W.email_address, W.mid, W.watch_time, M.title 
	  	FROM Movies M, Watches W, Users U, Follows F 
	  	WHERE M.mid = W.mid AND W.email_address = F.email2 AND U.email_address = W.email_address AND F.email1 = '$email'
	  	ORDER BY watch_time DESC";

		$watchResults=mysql_query($watchQuery);
		$watchCount=mysql_num_rows($watchResults);

		$suggested_followers_query = "SELECT U1.email_address, U1.name, M1.title, M1.year 
										FROM Watches W1, Movies M1, Users U1 
										WHERE M1.mid=W1.mid 
										AND W1.email_address = U1.email_address 
										AND U1.email_address != '$_SESSION[email]' 
										AND M1.mid 
										IN (
											SELECT M2.mid 
											FROM Movies M2, Watches W2 
											WHERE M2.mid=W2.mid AND W2.email_address='$_SESSION[email]')";

		/*"SELECT U1.email_address, U1.name, M1.title, M1.year
										FROM Watches W1, Movies M1, Users U1
										WHERE M1.mid=W1.mid AND W1.email_address = U1.email_address AND
												U1.email_address != '$_SESSION[email]' AND
												M1.mid IN (SELECT M2.mid
						 									FROM Movies M2, Watches W2
						 									WHERE M2.mid=W2.mid AND W2.email_address='$_SESSION[email])'";*/
		
		$suggestedFollowersResults = mysql_query($suggested_followers_query);
		$suggestFollowersCount = mysql_num_rows($suggestedFollowersResults);
	}


?>


<script type = "text/javascript">
function follow() {
	window.location.href = "<?php echo $followUrl; ?>";
}
</script>

<html>

	<head>
		<title></title>
		
		<style>
			form{
				margin-top:.5cm;
			 }
		</style>
			
	</head>
	<body>
	<?php include("import2.php"); ?>

<div class = "container">
	
<!-- Search Grid -->
<div class="row">
<div class="col-xs-6">
<div align="left">
<?php
	if(isset($_SESSION['email'])){
		echo "<a href=\"user.php?email=$_SESSION[email]\">";
	}
	else{
		echo "<a href=\"index.php\">";
	}
	echo "<img src=\"http://cs445.cs.umass.edu/groups/DGS/www/movieNetLogo.png\"/></a>";
?>
</div>
</div>
<div class="col-xs-6">
<br/>
<?php include("bar3.php") ?>
</div>
</div>
<!-- End Search Grid -->

<br/>
	<div class = "row">
		<div class = "col-xs-3">
			<p style="font-size: 200%;" ><?PHP echo $name; ?></p>
			<?PHP
				

				if(isset($email)){
					if(session_is_registered($email) && $email == $_SESSION['email']){
						$owner = "you";
					}
					else{
						$owner = "$email";

						if(isset($_SESSION['email'])){
    					$existQuery = "SELECT * FROM Follows WHERE email1='$_SESSION[email]' AND email2='$email'";
    					$existResults = mysql_query($existQuery);
    					if(mysql_num_rows($existResults) > 0){
								$buttonText = "Unfollow";
    					}
    					else{
			    			$buttonText = "Follow";
  			  		}    		
							echo "<input onClick=\"follow()\" type=\"submit\" name=\"follow\" value=\"$buttonText\">";
						}
					}
				}
				else{
					$owner = "--";
				}

			?>
			
		</div>
		
		<div class = "col-xs-6">
			
			<?php 
				if ($watchCount == 0){
					echo "<ul id=\"watchesBar\" class=\"list-group\">";
					echo "<li class=\"list-group-item\">No one $owner follow[s] has watched anything!</li>";
					echo "</ul>";
				}
				else{
					echo"<div id=\"watchesBar\" class=\"list-group\">";
					while ($row = mysql_fetch_array($watchResults)){
							echo "<a href=\"user.php?email=$row[1]\" class=\"list-group-item\">$row[0]</br>Watched $row[4] @ $row[3]</a>";
					}
					echo"</div>";
				}
			?>
			
			
		</div>

			
		

		<div class = "col-xs-3">

		<p style="font-size: 200%;" ><?PHP echo "Who to follow" ?></p>

			<?PHP

				if ($suggestFollowersCount == 0){
					echo "<ul id=\"followersBar\" class=\"list-group\">";
					echo "<li class=\"list-group-item\">No users to suggest!</li>";
					echo "</ul>";
				}
				else{
					echo"<div id=\"followersBar\" class=\"list-group\">";
					while ($row = mysql_fetch_array($suggestedFollowersResults)){
							echo "<a href=\"user.php?email=$row[0]\" class=\"list-group-item\">$row[1]</br>Watched the same movie: $row[2]</a>";
					}
					echo"</div>";
				}

			?>

			
		</div>
	</div>


	
</div>
		


	</body>
</html>