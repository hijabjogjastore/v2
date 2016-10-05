<?php
session_start();

include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];
$folderimg="../../../joimg/album/"; // Tempat upload file gambar

// Hapus Perusahaan Pengiriman
if ($module==$module AND $act=='hapus'){
	$id  = $_GET['id'];
	$gbr = $_GET['file'];
	
	$cek = mysql_fetch_array(mysql_query("SELECT gambar FROM album WHERE id_album='$id'"));
	if($cek['gambar']!=''){
	mysql_query("DELETE FROM album WHERE id_album='$id'");
    unlink("../../../joimg/album/$cek[gambar]");   
    unlink("../../../joimg/album/s_$cek[gambar]");
  } else { 
	mysql_query("DELETE FROM album WHERE id_album='$id'");
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
    UploadAlbum($nama_file_unik);
    mysql_query("INSERT INTO album(judul,
									tanggal,
                                    gambar) 
                            VALUES('$_POST[judul]',
									now(),
                                   '$nama_file_unik')");
	}
	else{
		mysql_query("INSERT INTO album(judul,
									tanggal) 
                            VALUES('$_POST[judul]',
									now())");
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
  $sql = mysql_query("SELECT gambar FROM album WHERE id_album='$_POST[id]'");
  $s    	= mysql_fetch_array($sql);
  unlink("../../../joimg/album/$s[gambar]");   
  unlink("../../../joimg/album/s_$s[gambar]");
  UploadAlbum($nama_file_unik);
  mysql_query("UPDATE album SET judul = '$_POST[judul]', gambar = '$nama_file_unik'  WHERE id_album = '$_POST[id]'");
  }
  else{
  mysql_query("UPDATE album SET judul = '$_POST[judul]' WHERE id_album = '$_POST[id]'");
  }
  
  header('location:../../media.php?module='.$module);
}


?>
