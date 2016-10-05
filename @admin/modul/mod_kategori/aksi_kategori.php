<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];
$id=$_POST['id'];

// Hapus kategori
if ($module=='kategori' AND $act=='hapus'){
  mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='kategori' AND $act=='input'){
	$seo = seo_title($_POST['nama']);
  mysql_query("INSERT INTO kategori(nama,seo) VALUES('$_POST[nama]', '$seo')");
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='kategori' AND $act=='update'){
	$seo = seo_title($_POST['nama']);
  mysql_query("UPDATE kategori SET nama='$_POST[nama]', seo= '$seo' WHERE id_kategori= '$id'");
  header('location:../../media.php?module='.$module);
}

?>
