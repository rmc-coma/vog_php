<?php
session_start();

include_once("r0f_dbselect.php");
include_once("r0f_dbdelete.php");
include_once("r0f_dbupdate.php");
include_once("r0f_dbinsert.php");

if ($_SESSION['user_type'] != 1)
	header('Location: index.php?info=Et non lol');
if ($_GET['action'] == 'trash')
{
	if ($_GET['select'] == 'orders')
	{
		r0f_dbdelete("DELETE FROM ORDERS WHERE o_id = ".$_GET['id'].";");
	}
	else if ($_GET['select'] == 'accounts')
	{
		r0f_dbdelete("DELETE FROM USER WHERE u_id = ".$_GET['id'].";");
	}
	header('Location: admin.php?select='.$_GET['select']);
}
else if ($_GET['action'] == 'update')
{
	if ($_GET['edit'] == 'products')
	{
		r0f_dbupdate("UPDATE PRODUCT SET p_name = '".$_POST['name']."', p_price = '".$_POST['price']."', p_capacity = '".$_POST['capacity']."',
			p_topspeed = '".$_POST['topspeed']."', p_acceleration = '".$_POST['acceleration']."', p_brake = '".$_POST['brake']."', p_traction = '".$_POST['traction']."', p_image = '".$_POST['image']."'
			WHERE p_id = '".$_GET['id']."';");
	}
	header('Location: admin.php?select=products');
}
else if ($_GET['action'] == 'add')
{
	if ($_GET['add'] == 'administrator')
	{
		r0f_dbinsert("INSERT INTO USER (u_group_id, u_login, u_password) VALUES ('1', '".$_POST['login']."', '".hash('whirlpool', $_POST['password'])."');");
	}
	header('Location: admin.php?select=administrators');
}
?>
<HTML>
<HEAD>
	<meta charset="utf-8" />
	<TITLE>Legendary Motorsports</TITLE>
	<link rel="stylesheet" type="text/css" href="sources/index.css" />
</HEAD>
<BODY>
	<?php include("r0p_banner.php") ?>
	<DIV id="core" style="min-height:90vw">
	<form action="./admin.php" method="GET">
		<select name="select" id="admin_select_task">
<?php
	if ($_GET['select'] == "orders")
		echo "<option id='admin_commandes' value='orders' selected>Commandes</option>";
	else
		echo "<option id='admin_commandes' value='orders'>Commandes</option>";
	if ($_GET['select'] == "accounts")
  		echo "<option id='admin_compte' value='accounts' selected>Comptes utilisateurs</option>";
	else
  		echo "<option id='admin_compte' value='accounts'>Comptes utilisateurs</option>";
	if ($_GET['select'] == "products")
  		echo "<option id='admin_produits' value='products' selected>Gestion produits</option>";
	else
  		echo "<option id='admin_produits' value='products'>Gestion produits</option>";
	if ($_GET['select'] == "administrators")
  		echo "<option id='admin_add_brand' value='administrators' selected>Ajouter un administrateur</option>";
	else
  		echo "<option id='admin_add_brand' value='administrators'>Ajouter un administrateur</option>";
?>
	<input type="submit" value="Trier" />
		</select>
		</form>
		<div>
<?php
	if ($_GET['select'])
	{
		if ($_GET['select'] == "orders")
		{
			$data = r0f_dbselect("SELECT ORDERS.o_id, USER.u_login, PRODUCT.p_name, ORDERS.o_color, ORDERS.o_date FROM USER, PRODUCT, ORDERS WHERE ORDERS.o_user_id = USER.u_id AND ORDERS.o_product_id = PRODUCT.p_id ORDER BY ORDERS.o_id");
			foreach ($data as $object => $value)
			{
				echo "<DIV class='commandes'>".$value['o_id']." ".$value['u_login']." ".$value['p_name']." ".$value['o_color']." ".$value['o_date']."</DIV>
			<a href='admin.php?select=".$_GET['select']."&action=trash&id=".$value['o_id']."'><img class='admin_destroy' src='sources/images/trash.jpg' /></a>";
			}
		}
		else if ($_GET['select'] == "accounts")
		{
			$data = r0f_dbselect("SELECT * FROM USER ORDER BY USER.u_id");
			foreach ($data as $object => $value)
			{
				echo "<DIV class='commandes'>".$value['u_id']." ".$value['u_login']." ".$value['u_email']." ".$value['u_adress']." ".$value['u_zipcode']." ".$value['u_city']." ".$value['u_country']."</DIV>
			<a href='admin.php?select=".$_GET['select']."&action=trash&id=".$value['u_id']."'><img class='admin_destroy' src='sources/images/trash.jpg' /></a>";
			}
		}
		else if ($_GET['select'] == 'products')
		{
			$data = r0f_dbselect("SELECT PRODUCT.p_id, P_BRAND.pb_name, PRODUCT.p_name, P_TYPE.pt_name, PRODUCT.p_price, PRODUCT.p_image FROM PRODUCT, P_BRAND, P_TYPE WHERE PRODUCT.p_brand_id = P_BRAND.pb_id AND PRODUCT.p_type_id = P_TYPE.pt_id ORDER BY PRODUCT.p_id");
			foreach ($data as $object => $value)
			{
				echo "<DIV class='commandes'>".$value['p_id']." ".$value['pb_name']." ".$value['p_name']." ".$value['pt_name']." ".$value['p_price']."</DIV>
			<a href='admin.php?edit=".($_GET['edit'] = "products")."&id=".$value['p_id']."'><img class='admin_destroy' src='".$value['p_image']."' /></a>
			<a href='admin.php?select=".$_GET['select']."&action=trash&id=".$value['p_id']."'><img class='admin_destroy' src='sources/images/trash.jpg' /></a>";
			}
		}
		else if ($_GET['select'] == 'administrators')
		{
			echo "<a href='admin.php?add=administrator'><img class='admin_view' src='sources/images/oeil.png'></a>";
			$data = r0f_dbselect("SELECT * FROM USER WHERE u_group_id = 1 ORDER BY USER.u_id");
			foreach ($data as $object => $value)
			{
				echo "<DIV class='commandes'>".$value['u_id']." ".$value['u_login']."</DIV>";
			}
		}
	}
	else if ($_GET['add'])
	{
		if ($_GET['add'] == 'administrator')
		{
			echo "<form action='admin.php?action=add&add=administrator' method='POST' style='margin-top:15vw;'>
					<table class='produits'>
						<tr><td>Cr&eacute;ation d'un nouveau compte administrateur</td></tr>
						<tr><td>Login</td><td><input type='text' name='login' /></td></tr>
						<tr><td>Password</td><td><input type='password' name='password' /></td></tr>
						<tr><td><input type='submit' name='submit' value='OK' /></td></tr>
					</table>
				  </form>";
		}
	}
	else if ($_GET['edit'])
	{
		if ($_GET['edit'] == "products")
		{
			$data = r0f_dbselect("SELECT PRODUCT.*, P_BRAND.*, P_TYPE.* FROM PRODUCT, P_BRAND, P_TYPE WHERE PRODUCT.p_id = ".$_GET['id']." AND PRODUCT.p_brand_id = P_BRAND.pb_id AND PRODUCT.p_type_id = P_TYPE.pt_id ORDER BY PRODUCT.p_id");
			echo "<form action='admin.php?edit=".$_GET['edit']."&action=update&id=".$_GET['id']."' method='POST' style='margin-top:15vw;'>
					<table class='produits'>
						<tr><td>Cr&eacute;ation nouvelle r&eacute;f&eacute;rence:</td></tr>
						<tr><td>Marque:</td>
						<tr><td>ID:<input type='text' value='".$data[0]['p_id']."' readonly></td></tr>
						<tr><td>Marque:<input type='text' value='".$data[0]['pb_name']."'></td></tr>
						<tr><td>Mod&egrave;le:</td><td><input type='text' name='name' maxlength='30' value='".$data[0]['p_name']."' /></td></tr>
						<tr><td>Type:</td><td><input type='text' name='type' value='".$data[0]['pt_name']."' readonly></td></tr>
						<tr><td>Prix :</td><td><input type='number' name='price' maxlength='30' value='".$data[0]['p_price']."' step=1000 min=0></td></tr>
						<tr><td>Places :</td><td><input type='number' name='capacity' maxlength='2' value='".$data[0]['p_capacity']."' step='any' min=0 max=5></td></tr>
						<tr><td>Vitesse maximale :</td><td><input type='number' name='topspeed' maxlength='6' value='".$data[0]['p_topspeed']."' step='any' min=0 max=5></td></tr>
						<tr><td>Acceleration :</td><td><input type='number' name='acceleration' maxlength='6' value='".$data[0]['p_acceleration']."' step='any' min=0 max=5></td></tr>	
						<tr><td>Freinage :</td><td><input type='number' name='brake' maxlength='6' value='".$data[0]['p_brake']."' step='any' min=0 max=5></td></tr>
						<tr><td>Tenue de route :</td><td><input type='number' name='traction' maxlength='6' value='".$data[0]['p_traction']."' step='any' min=0 max=5></td></tr>
						<tr><td>Image :</td><td><input type='url' name='image' value='".$data[0]['p_image']."'></td></tr>
						<tr><td>Soumettre:</td><td><input type='submit' name='submit' value='OK'></td></tr>
					  </table>
					</form>";
		}
	}
?>
		</div>
	</DIV>
</body>
</html>