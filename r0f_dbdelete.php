<?php
include_once("r0f_dbconnect.php");

function r0f_dbdelete($query)
{
	$connect = r0f_dbconnect();
	if (mysqli_connect_errno())
        return (-1);
	$r = mysqli_query($connect, $query);
	mysqli_close($connect);
	return ($r);
}
?>