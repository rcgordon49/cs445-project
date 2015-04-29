<?php
session_start();

//restricts access to only the admin
//CHANGE: address to admin one
if (!isset($_SESSION['email']) || $_SESSION['email'] != "testaddr@aol.com"){
	header('HTTP/1.0 404 Not Found');
	exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
		<title>Admin Page</title>
		<meta charset="utf-8">
    
    <!-- bootstrap libraryies: -->
    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 		
</head>
<script type="text/javascript">
query1 = "SELECT DISTINCT M.mid, M.title, M.year" +
				 "\nFROM Movies M" + 
				 "\nWHERE M.title LIKE 'Life%'";
					 
query2 = "SELECT M.mid, M.title, M.year" +
				 "\nFROM Acts_in A, Movies M" +
				 "\nWHERE A.pro_name = 'Pitt, Brad' AND M.mid = A.mid";

query3 = "SELECT DISTINCT A.pro_name" +
				 "\nFROM Directs D, Acts_in A" +
				 "\nWHERE A.mid = D.mid AND D.pro_name = 'Spielberg, Steven'";
					 
query4 = "SELECT DISTINCT R.user_rating, COUNT(*)" +
				 "\nFROM Rates R" +
				 "\nGROUP BY R.user_rating";
					 
query5 = "SELECT DISTINCT D.pro_name" +
				 "\nFROM Movies M, Directs D, Rates R, Users U" +
				 "\nWHERE R.email_address = U.email_address AND R.mid = M.mid AND D.mid = M.mid" +
  			 "\n  AND U.name = 'DERRICK MYERS' AND U.age = 36" + 
  			 "\n  AND R.user_rating = 10";
  					
query6 = "SELECT DISTINCT M.title, M.year, R.avg_user_age" +
				 "\nFROM Movies M, Avg_Ratings R" +
				 "\nWHERE M.mid = R.mid AND R.num_rates > 5000" +
				 "\nGROUP BY R.mid";

query7 = "SELECT DISTINCT U.email_address, U.name, U.age, U.location" +
				 "\nFROM Users U, Rates R, Has_Mpaa_Rating H" +
				 "\nWHERE U.age <= 17 AND U.email_address = R.email_address" +
				 "\n  AND R.mid = H.mid AND H.mpaa_rating = 'NC-17'";
					 
query8 = "SELECT DISTINCT R.title, R.year, R.avg_rating" + 
				 "\nFROM Avg_Ratings R" + 
				 "\nWHERE num_rates > 1000" + 
				 "\nORDER BY avg_rating DESC" + 
				 "\nLIMIT 5";

query9  = "SELECT DISTINCT R.email_address" +
					"\nFROM Rates R, Best_Movies B" + 
					"\nWHERE R.mid = B.mid" +
					"\nGROUP BY R.email_address" +
					"\nHAVING COUNT(*) >= 2 AND MIN(R.user_rating) >= 9";

query10 = "SELECT M.title, M.year, avg(R.user_rating)" +
					"\nFROM Movies M, Rates R, Good_Users G" + 
					"\nWHERE R.mid = M.mid AND R.email_address = G.email_address" +
					"\nGROUP BY M.mid" + 
					"\nHAVING COUNT(*) >= 2" +
					"\nORDER BY avg(R.user_rating) DESC" +
					"\nLIMIT 10";
							
testQueries = [query1, query2, query3, query4, query5, query6, query7, query8, query9, query10];

function addTestQuery(num){
	$("#sqlQuery").val(testQueries[num]);
	$("html, body").animate({ scrollTop: 0 }, "slow");
}
</script>

<body>
<h4 align="center">Admin Center</h4>
<p>&emsp;Insert your own SQL Query...</p>
<form id="queryForm" action="adminAction.php" method="post" align = "center">
<textarea name="sqlQuery" id="sqlQuery" form="queryForm" style="width: 500px; height:200px;"></textarea>
<br/>
<input type="submit" name="querySubmit" value="Submit Query" onclick="return confirm('Are you sure you want to submit this query?')">
</form>

<br/>
<br/>
<?php
if(isset($_GET['status'])){
	$status = $_GET['status'];
	echo "<div align=\"center\" >Query Error Message:&emsp;$status</div>";
}
?>
<br/>
<p>&emsp;...or select from one of these pre-written test queries.</p>

<h5>Test Queries:</h5>
<button id="testQuery1" onclick="addTestQuery(0);">Run Test Query 1</button>
Test Query 1: Find all movies that have “Life” as a prefix in the title.
<br/><br/>

<button id="testQuery2" onclick="addTestQuery(1);">Run Test Query 2</button>
Test Query 2: Find all movies that “Pitt, Brad” acted in.
<br/><br/>

<button id="testQuery3" onclick="addTestQuery(2);">Run Test Query 3</button>
Test Query 3:  Find the performers who acted in at least one movie directed by “Spielberg, Steven”.
<br/><br/>

<button id="testQuery4" onclick="addTestQuery(3);">Run Test Query 4</button>
Test Query 4:  Show the number of user ratings for each rating value.
<br/><br/>

<button id="testQuery5" onclick="addTestQuery(4);">Run Test Query 5</button>
Test Query 5: Find the directors of all movies that are rated 10 by “DERRICK MYERS” whose age is 36. Show the name of each director. 
<br/><br/>

<button id="testQuery6" onclick="addTestQuery(5);">Run Test Query 6</button>
Test Query 6: For each movie that is rated more than 5,000 times, show the title, year and the average age of the users who rate the movie.
<br/><br/>

<button id="tetQuery7" onclick="addTestQuery(6);">Run Test Query 7</button>
Test Query 7: Find the users who are 17 or under 17 and rate at least one “NC-17” movie. Show the email, name, age and location of each user.
<br/><br/>

<button id="testQuery8" onclick="addTestQuery(7);">Run Test Query 8</button>
Test Query 8: Find the 5 best movies. The 5 best movies are the 5 movies with the highest average rating. Only the movies rated more than 1,000 times are considered. Show the title, year and average rating of each best movie.
<br/><br/>

<button id="testQuery9" onclick="addTestQuery(8);">Run Test Query 9</button>
Test Query 9: Find all the users of good taste. A user is of good taste if and only if the user rates at least 2 of the 5 best movies, and the user never rates the 5 best movies with rating less than 9. Show the email of each user.
<br/><br/>

<button id="testQuery10" onclick="addTestQuery(9);">Run Test Query 10</button>
Test Query 10: Now we consider only the ratings from the users of good taste. Find the 10 movies with the highest average rating. Only the movies rated more than 2 times by the users of good taste are considered. Show the title, year and average rating of each best movie.
<br/><br/>

</body>
</html>
 