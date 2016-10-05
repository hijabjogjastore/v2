<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];
$id=$_POST['id'];

// Hapus kategori
if ($module=='category' AND $act=='hapus'){
  mysql_query("DELETE FROM category WHERE category_id='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='category' AND $act=='input'){
	$seo = seo_title($_POST['category_name']);
  mysql_query("INSERT INTO category(category_name,category_seo) VALUES('$_POST[category_name]', '$seo')");
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='category' AND $act=='update'){
	$seo = seo_title($_POST['category_name']);
  mysql_query("UPDATE category SET category_name='$_POST[category_name]', category_seo= '$seo' WHERE category_id= '$id'");
//echo $sql; exit();
  header('location:../../media.php?module='.$module);
}

?>
