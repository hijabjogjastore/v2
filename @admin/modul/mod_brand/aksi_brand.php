<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];
$id=$_POST['id'];

// Hapus kategori
if ($module=='brand' AND $act=='hapus'){
  mysql_query("DELETE FROM brand WHERE brand_id='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='brand' AND $act=='input'){
	$seo = seo_title($_POST['brand_name']);
  mysql_query("INSERT INTO brand(brand_name,brand_seo) VALUES('$_POST[brand_name]', '$seo')");
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='brand' AND $act=='update'){
	$seo = seo_title($_POST['brand_name']);
  mysql_query("UPDATE brand SET brand_name='$_POST[brand_name]', seo= '$seo' WHERE brand_id= '$id'");
  header('location:../../media.php?module='.$module);
}

?>
