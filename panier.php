<?PHP
session_start();
?>
<HTML>
<HEAD>
	<meta charset="utf-8" />
	<TITLE>Legendary Motorsports</TITLE>
	<link rel="stylesheet" type="text/css" href="sources/index.css" />
</HEAD>
<BODY>
	<?php include("r0p_banner.php"); ?>
	<DIV id="core" style="background-color: black;">
		<DIV id="panier"><img id="panier_black" src="sources/images/panier_black.jpg">Votre Panier<br /><br /></DIV>
		<table class="panier_row">
<?php
	if ($_COOKIE['cart'])
	{
		$cart = unserialize($_COOKIE['cart']);
		$total_price = 0;
		foreach ($cart as $product => $value)
		{
			echo "<tr>
					<td class='panier_content'><img src='".$value['img']."' /></td>
					<td class='panier_item_name'>".$value['brand']."&nbsp;".$value['name']."</td>
					<td class='panier_item_color_text'>".$value['color']."<span class='panier_item_color' style='background-color:".$value['color'].";'></span></td>
					<td><a href='r0_removefromcart.php?brand=".$value['brand']."&name=".$value['name']."&color=".$value['color']."'><img class='destroy' src='sources/images/trash.jpg'></a></td>
				</tr>";
			$total_price += $value['price'];
		}
		echo "<tr>
				<td id='checkout_total'>Total</td>
				<td id='checkout_total_value'>$".$total_price."</td>
				<td>
					<form action='r0_checkout.php' method='get'>";
		if ($_SESSION['logged'])
			echo "<input id='valid_panier' type='submit' name='submit' value='Valider le panier' />";
		else
			echo "<a href='register.php' id='valid_panier_inscription' type='submit'>Cliquez ici pour vous inscrire
        ou merci de vous connecter.</a>";
		echo "		</form>
				</td>
			</tr>";
	}
    else
        echo "<script>window.location = './index.php?info=Votre\ panier\ est\ vide';</script>";
?>				
		</table>
	</DIV>
</BODY>
</HTML>