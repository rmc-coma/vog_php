<?php
session_start();
include_once("r0f_dbinsert.php");
include_once("r0f_dbselect.php");

if ($_COOKIE['cart'] && $_SESSION['logged'])
{
	$cart = unserialize($_COOKIE['cart']);
	$i = count($cart);
	foreach ($cart as $product => $value)
	{
		if (r0f_dbselect("SELECT * FROM PRODUCT WHERE p_id = '".$value['id']."';"))
		{
			r0f_dbinsert("INSERT INTO ORDERS (o_user_id, o_product_id, o_color, o_date) VALUES ('".$_SESSION['user_id']."', '".preg_replace("/[\"\',=;\s]/", "", $value['id'])."', '".preg_replace("/[\"\',=;\s]/", "", $value['color'])."', NOW());");
		}
		else
		{
			header('Location: index.php?info=Stop toucher aux URLs OMG');
			setcookie("cart", NULL, 1);
			exit ;
		}
	}
	setcookie("cart", NULL, 1);
}
header('Location: index.php?info=Commande Effectuée');
?>