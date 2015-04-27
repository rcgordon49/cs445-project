<?PHP
	
	if(isset($_GET['pro_name'])){
		$pro_name = $_GET['pro_name'];
		echo "pro_name = $pro_name";
	}
	else{
		echo "No name";
		$pro_name = "Pitt, Brad"; //default 
	}
  
  include("dbConnect.php");
  
  $actQuery="SELECT A.role_name, M.mid, M.title, M.year FROM Acts_in A, Movies M WHERE A.pro_name='$pro_name' AND A.mid=M.mid";
	$actResults=mysql_query($actQuery);
	$actCount=mysql_num_rows($actResults);
	
	$dirQuery="SELECT M.mid, M.title, M.year FROM Directs D, Movies M WHERE D.pro_name='$pro_name' AND D.mid=M.mid";
	$dirResults=mysql_query($dirQuery);
	$dirCount=mysql_num_rows($dirResults);
	
	$prodQuery="SELECT M.mid, M.title, M.year FROM Produces P, Movies M WHERE P.pro_name='$pro_name' AND P.mid=M.mid";
	$prodResults=mysql_query($prodQuery);
	$prodCount=mysql_num_rows($prodResults);
	
	$editQuery="SELECT M.mid, M.title, M.year FROM Edits E, Movies M WHERE E.pro_name='$pro_name' AND E.mid=M.mid";
	$editResults=mysql_query($editQuery);
	$editCount=mysql_num_rows($editResults);
	
?>
<!DOCTYPE html>
<html lang="en">
 <head>
 		<title><?php echo "$pro_name"?></title>
    <meta charset=iso-8859-1">
 		 		
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
<?php include("import2.php"); ?>

<div class="container">

<!-- Search Grid -->
<div class="row">
<div class="col-xs-6">
<div align="left">
<?php
	session_start();
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

<!-- Main Page Grid: -->
<div class="row">
<div class="col-xs-1">
</div>
<div class="col-xs-10">

<div id="titleBox">
<?php echo "$pro_name</br>"; ?>
</div>

<!-- Accordian Time -->
<div class="panel-group" id="role-lists">

<!-- actor panel -->
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><a data-toggle="collapse" data-parent="#role-lists" href="#actorPanel">Actor</a></h3>
<h4><?php echo "($actCount roles)" ?></h4>
</div>
<div id="actorPanel" class="panel-collapse collapse">
<div class="panel-body">
<div class="list-group">
<?php
if ($actCount > 0){
	while ($row = mysql_fetch_array($actResults)){
			if($row[0] == ''){
				$roleStr = "--&emsp;&emsp;$row[2]&emsp;($row[3])";
			}
			else{
				$roleStr = "$row[0]&emsp;&emsp;$row[2]&emsp;($row[3])";
			}
			echo "<a href=\"movie.php?mid=$row[1]\" class=\"list-group-item\">$roleStr</a>";
	}
}
echo "</div></br></br>";
?>
</div>
</div>
</div>

<!-- director panel -->
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><a data-toggle="collapse" data-parent="#role-lists" href="#directorPanel">Director</a></h3>
<h4><?php echo "($dirCount roles)" ?></h4>
</div>
<div id="directorPanel" class="panel-collapse collapse">
<div class="panel-body">
<div class="list-group">
<?php
if ($dirCount > 0){
	while ($row = mysql_fetch_array($dirResults)){
			echo "<a href=\"movie.php?mid=$row[0]\" class=\"list-group-item\">$row[1]&emsp;&emsp;($row[2])</a>";
	}
}
echo "</div></br></br>";
?>
</div>
</div>
</div>


<!-- producer panel -->
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><a data-toggle="collapse" data-parent="#role-lists" href="#producerPanel">Producer</a></h3>
<h4><?php echo "($prodCount roles)" ?></h4>
</div>
<div id="producerPanel" class="panel-collapse collapse">
<div class="panel-body">
<div class="list-group">
<?php
if ($prodCount > 0){
	while ($row = mysql_fetch_array($prodResults)){
			echo "<a href=\"movie.php?mid=$row[0]\" class=\"list-group-item\">$row[1]&emsp;&emsp;($row[2])</a>";
	}
}
echo "</div></br></br>";
?>
</div>
</div>
</div>


<!-- editor panel -->
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><a data-toggle="collapse" data-parent="#role-lists" href="#editorPanel">Editor</a></h3>
<h4><?php echo "($editCount roles)" ?></h4>
</div>
<div id="editorPanel" class="panel-collapse collapse">
<div class="panel-body">
<div class="list-group">
<?php
if ($editCount > 0){
	while ($row = mysql_fetch_array($editResults)){
			echo "<a href=\"movie.php?mid=$row[0]\" class=\"list-group-item\">$row[1]&emsp;&emsp;($row[2])</a>";
	}
}
echo "</div></br></br>";
?>
</div>
</div>
</div>

</div>
<!-- End Accordian Time -->

</div>
<div class="col-xs-1">

</div>
</div>
<!-- End Main Page Grid -->



</div>


</body>
</html>