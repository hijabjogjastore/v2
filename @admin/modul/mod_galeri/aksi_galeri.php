<?php
session_start();

include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];
$folderimg="../../../joimg/galeri/"; // Tempat upload file gambar

// Hapus Perusahaan Pengiriman
if ($module==$module AND $act=='hapus'){
	$id  = $_GET['id'];
	$gbr = $_GET['file'];
	
	$cek = mysql_fetch_array(mysql_query("SELECT gambar FROM galeri WHERE id_galeri='$id'"));
	if($cek['gambar']!=''){
	mysql_query("DELETE FROM galeri WHERE id_galeri='$id'");
    unlink("../../../joimg/galeri/$cek[gambar]");   
    unlink("../../../joimg/galeri/s_$cek[gambar]");
  } else { 
	mysql_query("DELETE FROM galeri WHERE id_galeri='$id'");
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
    UploadGaleri($nama_file_unik);
    mysql_query("INSERT INTO galeri(judul,
								   id_album,
									tanggal,
                                    gambar) 
                            VALUES('$_POST[judul]',
								   '$_POST[id_album]',
									now(),
                                   '$nama_file_unik')");
	}
	else{
		mysql_query("INSERT INTO galeri(judul,
									id_album,
									tanggal) 
                            VALUES('$_POST[judul]',
								   '$_POST[id_album]',
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
  $sql = mysql_query("SELECT gambar FROM galeri WHERE id_galeri='$_POST[id]'");
  $s    	= mysql_fetch_array($sql);
  unlink("../../../joimg/galeri/$s[gambar]");   
  unlink("../../../joimg/galeri/s_$s[gambar]");
  UploadGaleri($nama_file_unik);
  mysql_query("UPDATE galeri SET judul = '$_POST[judul]', id_album = '$_POST[id_album]', gambar = '$nama_file_unik'  WHERE id_galeri = '$_POST[id]'");
  }
  else{
  mysql_query("UPDATE galeri SET judul = '$_POST[judul]', id_album = '$_POST[id_album]' WHERE id_galeri = '$_POST[id]'");
  }
  
  header('location:../../media.php?module='.$module);
}


?>
