<?PHP
/*
TO DO:

-- hitting rate will cycle back to the page w/o the original $mid (reverting to default)
-- so feed current mid to the aciton.php file

*/

/*
	if($_POST && isset($_POST['rating'])) {
		if (empty($_POST["rating"])) {
			echo "Need to rate something.";
		} else {
    	$rating = test_input($_POST["rateButton"]);
    	echo "You have chosen to rate this movie: $rating";
  	}
	}
	*/
	if(isset($_GET['mid'])){
		$mid = $_GET['mid'];
		echo "mid = $mid";
	}
	else{
		echo "No mid";
		$mid = 300352; //default movie is "Hard to Kill" 2007
	}
	
	if(isset($_GET['rating'])){
		$rating = $_GET['rating'];
		echo "Rating = $rating";
	}
	else{
		echo "No rating";
	}
	
	if(isset($_GET['success'])){
		echo "success status: $_GET[success].";
	}
	

  //$title = "Hard to Kill";
  //$year = "1990";
  
  include("dbConnect.php");
  $movieQuery="SELECT * FROM Movies M WHERE M.mid='$mid'";
  $movieResults=mysql_query($movieQuery);
  $movieCount=mysql_num_rows($movieResults);
  
	$row = mysql_fetch_array($movieResults);
	$title = $row[1];
	$year = $row[2];
  
  $watchQuery="SELECT U.name, W.email_address, W.mid, W.watch_time FROM Watches W, Users U WHERE W.email_address = U.email_address AND mid='$mid' ORDER BY watch_time DESC";
	$watchResults=mysql_query($watchQuery);
	$watchCount=mysql_num_rows($watchResults);
	
	$avgQuery="SELECT * FROM Avg_Ratings A WHERE A.mid = '$mid'";
	$avgResults = mysql_query($avgQuery);
	$avgCount = mysql_num_rows($avgResults);
	
	$keywordsQuery = "SELECT * FROM Has_Key_Word K WHERE K.mid='$mid'";
	$keywordResults = mysql_query($keywordsQuery);
	$keyCount = mysql_num_rows($keywordResults);
	
	$genresQuery = "SELECT * FROM Has_Genre G WHERE G.mid='$mid'";
	$genreResults = mysql_query($genresQuery);
	$genreCount = mysql_num_rows($genreResults);
	
	$mpaaQuery = "SELECT R.mpaa_rating, R.definition FROM Mpaa_Rating R, Has_Mpaa_Rating H, Movies M WHERE M.mid='$mid' AND M.mid=H.mid AND H.mpaa_rating=R.mpaa_rating";
	$mpaaResults = mysql_query($mpaaQuery);
	$mpaaCount = mysql_num_rows($mpaaResults);
	
	$castQuery = "SELECT * FROM Acts_in A WHERE A.mid='$mid' ORDER BY pro_name";
	$castResults = mysql_query($castQuery);
	$castCount = mysql_num_rows($castResults);
	
	$dirQuery = "SELECT * FROM Directs D WHERE D.mid='$mid' ORDER BY pro_name";
	$dirResults = mysql_query($dirQuery);
	$dirCount = mysql_num_rows($dirResults);
	
	$prodQuery = "SELECT * FROM Poduces P WHERE P.mid='$mid' ORDER BY pro_name";
	$prodResults = mysql_query($prodQuery);
	$prodCount = mysql_num_rows($prodResults);
	
	$editQuery = "SELECT * FROM Poduces P WHERE P.mid='$mid' ORDER BY pro_name";
	$editResults = mysql_query($editQuery);
	$editCount = mysql_num_rows($editResults);
	
	$watchUrl = "watchAction.php?mid=$mid";
?>
<script type="text/javascript">
	function watch(){
		//window.alert("<?php echo $watchUrl; ?>");
		window.location.href = "<?php echo $watchUrl; ?>";
	}
</script>

<!DOCTYPE html>
<html lang="en">
 <head>
 		<title><?php echo "$title"?></title>
    <meta charset="utf-8">
    
    <!-- bootstrap libraryies: -->
    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 		
 		<style>
 			#titleBox{
				font-size: 200%;
			}

			.col-centered{
				float: none;
				margin: 0 auto;
			}
		</style

 </head>
<html>

<body>
<div class="container">

<!-- Search Grid -->
<div class="row">
<div class="col-cs-7">
</div>
<div class="col-cs-5">
<?php include("bar.php") ?>
</div>
</div>


<!-- Main Page Grid: -->
<div class="row">
<div class="col-xs-8">

<div id="titleBox">
<?php echo "$title ($year)</br>"; ?>
</div>

<div class="panel panel-default">
<div id="infoBox" class="panel-body">
<?php 

//displays average rating of movie
if ($avgCount == 0){
	echo "Average Rating: This movie has not yet been rated.";
}
else{
	$row = mysql_fetch_array($avgResults);
	echo "Average Rating: $row[4]";
}
echo "</br></br>";
?>

<form method="POST" action="rateAction.php" accept-charset="UTF-8" class="form-inline" role="form">
  <label class="radio-inline"><input type="radio" name="rating" value="1">1</label>
  <label class="radio-inline"><input type="radio" name="rating" value="2">2</label>
  <label class="radio-inline"><input type="radio" name="rating" value="3">3</label>
  <label class="radio-inline"><input type="radio" name="rating" value="4">4</label>
  <label class="radio-inline"><input type="radio" name="rating" value="5">5</label>
  <label class="radio-inline"><input type="radio" name="rating" value="6">6</label>
  <label class="radio-inline"><input type="radio" name="rating" value="7">7</label>
  <label class="radio-inline"><input type="radio" name="rating" value="8">8</label>
  <label class="radio-inline"><input type="radio" name="rating" value="9">9</label>
  <label class="radio-inline"><input type="radio" name="rating" value="10">10</label>
  <input type="hidden" name="mid" value=<?php echo "\"$mid\""; ?>>
  <button type="submit" name="rateButton" class="btn btn-default">Rate</button>
</form>

<?php
//displays list of genres that describe the movie
if ($genreCount == 0){
	echo "Genres: none";
}
else{
	echo "Genres:&emsp;&emsp;";
	while ($row = mysql_fetch_array($genreResults)){
			echo "$row[1]&emsp;&emsp;";
	}
}
echo "</br></br>";
 
//displays list of keywords that belong to the movie
if ($keyCount == 0){
	echo "Keywords: none";
}
else{
	echo "Keywords:&emsp;&emsp;";
	while ($row = mysql_fetch_array($keywordResults)){
			echo "$row[0]&emsp;&emsp;";
	}
}
echo "</br></br>";

//displays mpaa rating of movie
if ($mpaaCount == 0){
	echo "This movie not yet rated.";
}
else{
	$row = mysql_fetch_array($mpaaResults);
	echo "Rated $row[0]&emsp;&emsp;$row[1]";
}
echo "</br></br>";
	
?>
</div>
</div>

<div class="panel panel-default">
<div id="crewBox" class="panel-body">
<h3>Crew List</h3>
<?php

//displays list of directors
echo "Directors:&emsp;&emsp;";
if ($dirCount > 0){
	while ($row = mysql_fetch_array($dirResults)){
			echo "$row[0]&emsp;&emsp;";
	}
}
echo "</br></br>";

//displays list of producers
echo "Producers:&emsp;&emsp;";
if ($prodCount > 0){
	while ($row = mysql_fetch_array($prodResults)){
			echo "$row[0]&emsp;&emsp;";
	}
}
echo "</br></br>";

//displays list of editors
echo "Editors:&emsp;&emsp;";
if ($editCount > 0){
	while ($row = mysql_fetch_array($editResults)){
			echo "$row[0]&emsp;&emsp;";
	}
}
echo "</br></br>";

?>
</div>
</div>

<div class="panel panel-default">
<div id="castBox" class="panel-body">
<h3>Cast List</h3>
<ul class="list-group">
<?php
//displays cast
if ($keyCount == 0){
	echo "no actors";
}
else{
	while ($row = mysql_fetch_array($castResults)){
			echo "<li class=\"list-group-item\">$row[0]&emsp;&emsp;$row[2]</li>";
	}
}
echo "</ul></br></br>";
?>
</div>
</div>

</div>
<div class="col-xs-4">
<div id="watchesBar" class="list-group">
<button type="button" class="btn btn-default" onclick="watch();">I just watched this movie!</button>
</br></br>
<?php 

if ($watchCount == 0){
	echo "<a href=\"#\" class=\"list-group-item\">No one has watched this movie yet.</a>";
}
else{
	while ($row = mysql_fetch_array($watchResults)){
			echo "<a href=\"user.php?email=$row[1]\" class=\"list-group-item\">$row[0]</br>Watched $title @ $row[3]</a>";
	}
}
?>
</div>
</div>
</div>

</body>
</html>