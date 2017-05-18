<?php
include('r0f_dbconnect.php');
if (isset($_POST['submit']))
{
	$link = r0f_dbconnect();
	$sql = file_get_contents("db.sql");
	$sql_array = explode(";", $sql);
	foreach ($sql_array as $val) 
	{
		mysqli_query($link, $val); 
	}
}
else
	echo "<form action='install.php' method='post'><input type='submit' name='submit' id='' value='Installer' /></form>";
?>

