<html><body>
<?php
$name = $_POST['name'];
$age = $_POST['age'];

echo $name;
echo $age;

?>

<?php
  $connection = mysql_connect("cs445sql", "rwstanle", "EL310rws");
  if (!$connection){
    die ("Couldn't connect to mysql server!<br>The error was: " . mysql_error());
  }
  else{
    echo "Connection successful!<br>\n";
  }
  if (!mysql_select_db("DGS"))
    die ("Couldn't select a database!<br> Error: " . mysql_error());
  else
    echo "Databse selected successfully.<br>\n";

  $query = "SELECT DISTINCT M.mid, M.title, M.year FROM Movies M WHERE M.title LIKE 'Life%'";
  $result = mysql_query($query);
  if (!$result)
    echo "Query failed!";
  else{
    echo "Query successful.<br>\n";
    echo "Songs:<br>";
    while ($row = mysql_fetch_array($result)){
      echo "mid: $row[0], title: $row[1], year: $row[2]<br>\n";
    }
  }
?>
</body></html>