<?php
session_start();
include_once("r0f_dbselect.php");

if (isset($_POST) && isset($_SESSION))
{
	$result = r0f_dbselect("SELECT * FROM USER WHERE u_login = '".$_POST['login']."' AND u_password = '".hash('whirlpool', $_POST['password'])."';");
	if ($result == -1)
		echo "Failed to connect to DB\n";
	else if ($result == 0)
	{
		header('Location: index.php?info=Cet utilisateur n\'existe pas');
	}
	else
    {
		$_SESSION['logged'] = true;
		$_SESSION['logged_as'] = $result[0]['u_login'];
		$_SESSION['user_id'] = $result[0]['u_id'];
		$_SESSION['user_type'] = $result[0]['u_group_id'];
		header('Location: index.php?info=Connecté');
    }
}
?>