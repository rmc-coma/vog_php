<?php
include_once("r0f_dbconnect.php");

function r0f_dbupdate($query)
{
	$connection = r0f_dbconnect();
	if (mysqli_connect_errno())
        return (-1);
	if ($result = mysqli_query($connection, $query))
    {
        mysqli_close($connection);
        return ($result);
    }
    mysqli_close($connection);
    return (0);
}