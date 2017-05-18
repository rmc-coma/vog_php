<?php
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
	<DIV id="core" style="min-height: 65vmin;">
<?php
	if ($_SESSION['logged'])
		echo "<span id='info_message'>Vous etes deja connecte</span>";
	else
	{
		if ($_GET)
			echo "<span id='info_message'>".$_GET['info']."</span>";
		echo "
		<form action='r0_register.php' method='POST'>
			<table id='register_table'>
			<tr></tr>
			<tr></tr>
				<tr><td class='register_td'>Login :</td><td><input class='register_input' type='text' name='login' /></td></tr>
				<tr><td class='register_td'>Mot de passe :</td><td><input class='register_input' type='password' name='password' /></td></tr>
				<tr><td class='register_td'>R&eacute;peter le mot de passe :</td><td><input  class='register_input' type='password' name='password_dup'/></td></tr>
				<tr><td class='register_td'>E-mail :</td><td><input  class='register_input' type='email' name='email' /></td></tr>
				<tr><td class='register_td'>Adresse :</td><td><input  class='register_input' type='text' name='adress' /></td></tr>
				<tr><td class='register_td'>Code postale :</td><td><input  class='register_input' type='text' name='zipcode' /></td></tr>
				<tr><td class='register_td'>Ville :</td><td><input  class='register_input' type='text' name='city' /></td></tr>
				<tr><td class='register_td'>Pays :</td><td><input  class='register_input' type='text' name='country' /></td></tr>
			</table>
			<input id='register_submit' type='submit' name='submit' value='Envoyer' />
		</form>";
	}
?>
	</DIV>
</BODY>
</HTML>