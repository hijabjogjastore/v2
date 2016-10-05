<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];
$id=$_POST['id'];
$subcategory=$_POST['subcategory'];

// Hapus Sub kategori
if ($module=='subkategori' AND $act=='hapus'){
  mysql_query("DELETE FROM subkategori WHERE id_subkategori='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input Sub kategori
elseif ($module=='subkategori' AND $act=='input'){
  $seo = seo_title($_POST['nama']);
  mysql_query("INSERT INTO subkategori(nama,seo,tanggal,id_kategori) VALUES('$_POST[nama]', '$seo', now(),'$_POST[kategori]')");
  header('location:../../media.php?module='.$module);
}

// Update Sub kategori
elseif ($module=='subkategori' AND $act=='update'){
  $seo = seo_title($_POST['nama']);
  mysql_query("UPDATE subkategori SET id_kategori= '$_POST[kategori]', nama='$_POST[nama]', seo= '$seo', tanggal=now() WHERE id_subkategori= '$id'");
  header('location:../../media.php?module='.$module);
}

?>
