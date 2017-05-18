<?php
session_start();
echo "<DIV id='banner'>
        <a href='index.php'><img id='banner_img' src='sources/images/banner-img.png' alt='Legendary Motorsport' /></a>
        <ul id='panier_menu'><a href='panier.php'>Panier<img id='panier_black_menu' src='sources/images/panier_black.jpg'></a></ul>
		<ul id='body_menu'>
            <li id='connexion'>Connexion
                <ul id='scroll_menu'>";
if (isset($_SESSION) && isset($_SESSION['logged']) && $_SESSION['logged'])
{
	echo "Connect&eacute; en tant que ".$_SESSION['logged_as']."<br />";
	if ($_SESSION['user_type'] == 1)
		echo "<a href='admin.php'>Administration</a><br />";
	else
		echo "<a href='unregister.php'>Supprimer mon compte</a><br />";
	echo "<a href='r0_logout.php'>Se D&eacute;connecter</a>";
}
else
{
	echo "<li id='connexion'>
                <ul id='scroll_menu'>
                  <form action='r0_login.php' method='post'>
                    <table>
                      <tr><td>Identifiant: </td><td><input type='text' name='login' id='login'/></td></tr>
                      <tr><td>Mot de passe: </td><td><input type='password' name='password' id='pass'/></td>
                      <td><input type='submit' name='submit' value='OK' /></td></tr>
                    </table>
                  </form>
               <li id='new_account_link'><a href='register.php'>Cr&eacute;er un nouveau compte</a>
              </ul>
            </li>";
    }
echo "</ul></li></ul></DIV>";
?>