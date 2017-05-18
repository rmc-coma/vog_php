<?php
if ($_GET)
{
	if ($_COOKIE['cart'])
	{
		$cart = unserialize($_COOKIE['cart']);
		$i = count($cart);
	}
	else
	{
		$i = 0;
	}
	if ($i >= 8)
	{
		header('Location: index.php?info=Votre Panier est plein');
		exit ;
	}
	$cart[$i]['id'] = $_GET['id'];
	$cart[$i]['brand'] = $_GET['brand'];
	$cart[$i]['name'] = $_GET['name'];
	$cart[$i]['color'] = $_GET['color'];
	$cart[$i]['img'] = $_GET['img'];
	$cart[$i]['price'] = $_GET['price'];
	setcookie("cart", serialize($cart), time() + 3600);
}
header('Location: index.php');
?>