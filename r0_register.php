<?php
session_start();
include_once("r0f_dbselect.php");
include_once("r0f_dbinsert.php");

$info = 0;
if (isset($_POST) && isset($_SESSION))
{
	$r_pattern = "/[\"\',=;\s]/";
	$login = preg_replace($r_pattern, "", $_POST['login']);
	$password = hash('whirlpool', $_POST['password']);
	$password_dup = hash('whirlpool', $_POST['password_dup']);
	$email = preg_replace($r_pattern, "", $_POST['email']);
	$adress = preg_replace("/[\"\',=;]/", "", $_POST['adress']);
	$zipcode = preg_replace([$r_pattern, "/[^\d]/"], "", $_POST['zipcode']);
	$city = preg_replace($r_pattern, "", $_POST['city']);
	$country = preg_replace($r_pattern, "", $_POST['country']);
	if (!preg_match("/(\b\d\d\d\d\d\b)/", $zipcode) || !preg_match("/\b.*@.*\.\w{2,3}\b/", $email) || $city == "" || $country == "" || $login == "" || $password == "" || $password_dup == "")
		$info = "Invalid values";
	else 
	{
		if ($password == $password_dup)
		{
			$qr = r0f_dbselect("SELECT * FROM USER WHERE u_login = '".$login."' OR u_email = '".$email."';");
			if ($qr == -2)
				$info = "Unknown error";
			else if ($qr == -1)
				$info = "Failed to query db";
			else if ($qr != 0)
				$info = "User already exists";
			else
			{
				if (r0f_dbinsert("INSERT INTO USER (u_group_id, u_login, u_email, u_password, u_address, u_zipcode, u_city, u_country) VALUES ('2', '".$login."', '".$email."', '".$password."', '".$adress."', '".$zipcode."', '".$city."', '".$country."');"))
				{
					$_SESSION['logged'] = true;
					$_SESSION['logged_as'] = $login;
					$_SESSION['user_id'] = $qr[0]['u_id'];
					$_SESSION['user_type'] = $qr[0]['u_group_id'];
					header('Location: index.php');
					$info = "Account successfully created\n";
					exit ;
				}
				else
					$info = "Failed to insert into db";
			}
		}
		else
			$info = "Wrong password confirmation";
	}
}
header('Location: register.php?&info='.$info);
?>