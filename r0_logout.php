<?php
session_start();

if (isset($_SESSION) && isset($_SESSION['logged']) && $_SESSION['logged'])
{
	$_SESSION['logged'] = false;
	$_SESSION['logged_as'] = "";
	$_SESSION['user_id'] = 0;
	$_SESSION['user_type'] = 0;
	setcookie("cart", NULL, 1);
}
header('Location: index.php');
?>