<?php
session_start();
include("r0f_dbdelete.php");

if ($_SESSION['logged'] && $_SESSION['user_id'])
{
	if (r0f_dbdelete("DELETE FROM USER WHERE u_id = ".$_SESSION['user_id'].";") > 0)
	{
		$_SESSION['logged'] = false;
		$_SESSION['user_id'] = 0;
		$_SESSION['logged_as'] = "";
		$_SESSION['user_type'] = 0;
		header('Location: index.php?info=Supprimé avec succès');
		exit ;
	}
	header('Location: index.php?info=Cet utilisateur n\'existe pas');
	exit ;
}
header('Location: index.php');
?>