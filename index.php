<?PHP
session_start();
include_once("r0f_dbselect.php");

if ($_GET)
{
	if ($_GET['type_filter'])
		$_SESSION['type_filter'] = $_GET['type_filter'];
	if ($_GET['sort_by'])
		$_SESSION['sort_by'] = $_GET['sort_by'];
}
?>
<HTML>
<HEAD>
	<meta charset="utf-8" />
	<TITLE>Legendary Motorsports</TITLE>
	<link rel="stylesheet" type="text/css" href="sources/index.css" />
</HEAD>
<BODY>
	<?php include("r0p_banner.php"); ?>
	<DIV id="core">
<?php 
	if ($_GET['info'])
		echo "<span id='info_message'>".$_GET['info']."</span>";
?>
		<DIV id="forms">
			<DIV>
				<form id="sort_by_type_form" action="#" method="get">
					<select id="sort_by_type" name="type_filter">
<?php
	$objects = r0f_dbselect("SELECT * FROM P_TYPE ORDER BY pt_name;");
	if ($_SESSION['type_filter'] != -1)
		echo "<option value='-1'>Tous les types</option>";
	else
		echo "<option selected value='-1'>Tous les types</option>";
	foreach ($objects as $type)
	{
		if ($_SESSION['type_filter'] && $_SESSION['type_filter'] == $type['pt_id'])
			echo "<option selected value='".$type['pt_id']."'>".$type['pt_name']."</option>";
		else
			echo "<option value='".$type['pt_id']."'>".$type['pt_name']."</option>";
	}
?>	
					</select>
					<input id="sort_by_type_submit" type="submit" value="Afficher" />
				</form>	
			</DIV>
			<DIV>
				<form id="sort_by_form" action="#" method="get">
					<select id="sort_by" name="sort_by">
<?php
		if ($_SESSION['sort_by'])
		{
			if ($_SESSION['sort_by'] == "name")
			{
				echo "<option selected value='name' checked>Tri par nom</option><option value='price' checked>Tri par prix croissant</option><option value='rprice' checked>Tri par prix d&eacute;croissant</option>";
				$order = "pb_name, p_name";
			}
			else if ($_SESSION['sort_by'] == "price")
			{
				echo "<option value='name' checked>Tri par nom</option><option selected value='price' checked>Tri par prix croissant</option><option value='rprice' checked>Tri par prix d&eacute;croissant</option>";
				$order = "p_price, p_name";
			}
			else if ($_SESSION['sort_by'] == "rprice")
			{
				echo "<option value='name' checked>Tri par nom</option><option value='price' checked>Tri par prix croissant</option><option selected value='rprice' checked>Tri par prix d&eacute;croissant</option>";
				$order = "p_price desc";
			}
			else
			{
				echo "<option selected value='name' checked>Tri par nom</option><option value='price' checked>Tri par prix croissant</option><option value='rprice' checked>Tri par prix d&eacute;croissant</option>";
				$order = "pb_name, p_name";
			}
		}
		else
		{
			echo "<option selected value='name' checked>Tri par nom</option><option value='price' checked>Tri par prix croissant</option><option value='rprice' checked>Tri par prix d&eacute;croissant</option>";
			$order = "pb_name, p_name";
		}
?>
					</select>
					<input id="sort_by_submit" type="submit" value="Trier"/>
				</form>	
			</DIV>
		</DIV>
<?php
	if ($_SESSION['type_filter'] <= 0)
		$objects = r0f_dbselect("SELECT PRODUCT.*, P_BRAND.* FROM PRODUCT, P_BRAND WHERE PRODUCT.p_brand_id = P_BRAND.pb_id ORDER BY ".$order);
	else
		$objects = r0f_dbselect("SELECT PRODUCT.*, P_BRAND.* FROM PRODUCT, P_BRAND WHERE PRODUCT.p_brand_id = P_BRAND.pb_id AND PRODUCT.p_type_id = '".$_SESSION['type_filter']."' ORDER BY ".$order.";");
	foreach ($objects as $car)
		echo "<a href='description.php?id=".$car['p_id'].
			"&brand=".$car['pb_name'].
			"&name=".$car['p_name'].
			"&price=".$car['p_price'].
			"&topspeed=".$car['p_topspeed'].
			"&acceleration=".$car['p_acceleration'].
			"&brake=".$car['p_brake'].
			"&traction=".$car['p_traction'].
			"&img=".$car['p_image']."'><DIV class='content'><img src='".$car['p_image']."'></img><span class='brandname'>".$car['pb_name']."</span><span class='carname'>".$car['p_name']."</span><span class='price'>$&nbsp;".$car['p_price']."</DIV></a>";
?>	
	</DIV>
</BODY>
</HTML>