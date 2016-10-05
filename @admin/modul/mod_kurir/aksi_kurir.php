<?php
session_start();

include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];
$folderimg="../../../assets/images/shipping/"; // Tempat upload file gambar

// Hapus Perusahaan Pengiriman
if ($module==$module AND $act=='hapus'){
	$id  = $_GET['id'];
	$gbr = $_GET['file'];
	
	$cek = mysql_fetch_array(mysql_query("SELECT gambar FROM mod_kurir WHERE id_kurir='$id'"));
	if($cek['gambar']!=''){
	mysql_query("DELETE FROM mod_kurir WHERE id_kurir='$id'");
    unlink("../../../assets/images/shipping/$cek[gambar]");   
    unlink("../../../assets/images/shipping/s_$cek[gambar]");
  } else { 
	mysql_query("DELETE FROM mod_kuir WHERE id_kurir='$id'");
	}
	
	header('location:../../media.php?module='.$module);
}

// Input Perusahaan Pengiriman
elseif ($module=="$module" AND $act=='input'){
  
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  // Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){
    UploadShipping($nama_file_unik);
    mysql_query("INSERT INTO mod_kurir(nama_kurir,link,
                                    gambar) 
                            VALUES('$_POST[nama_kurir]','$_POST[link]',
                                   '$nama_file_unik')");
	}
	else{
		 mysql_query("INSERT INTO mod_kurir(nama_kurir,link) 
                            VALUES('$_POST[nama_kurir]','$_POST[link]')");
	}
	header('location:../../media.php?module='.$module);
}

// Update Perusahaan Pengiriman

elseif ($module=="$module" AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  if (!empty($lokasi_file)){
  $sql = mysql_query("SELECT gambar FROM mod_kurir WHERE id_kurir='$_POST[id]'");
  $s    	= mysql_fetch_array($sql);
  unlink("../../../assets/images/shipping/$s[gambar]");   
  //unlink("../../../assets/images/shipping/s_$s[gambar]");
  UploadShipping($nama_file_unik);
  mysql_query("UPDATE mod_kurir SET nama_kurir = '$_POST[nama_kurir]', link = '$_POST[link]', gambar = '$nama_file_unik'  WHERE id_kurir = '$_POST[id]'");
  }
  else{
  mysql_query("UPDATE mod_kurir SET nama_kurir = '$_POST[nama_kurir]',link = '$_POST[link]' WHERE id_kurir = '$_POST[id]'");
  }
  
  header('location:../../media.php?module='.$module);
}


?>
