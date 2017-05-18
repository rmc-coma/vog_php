<?php
if ($_GET && $_GET['brand'] && $_GET['name'] && $_GET['color'])
{
	if ($_COOKIE['cart'])
	{
		$cart = unserialize($_COOKIE['cart']);
		$i = 0;
		foreach ($cart as $product => $value)
		{
			if (!($value['brand'] == $_GET['brand'] && $value['name'] == $_GET['name'] && $value['color'] == $_GET['color']))
				$new[$i++] = $value;
		}
		setcookie("cart", serialize($new), time() + 3600);
	}
}
header("Location: panier.php");
?>