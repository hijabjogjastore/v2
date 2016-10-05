<?php
session_start();

include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];
$folderimg="../../../joimg/news/"; // Tempat upload file gambar

// Hapus Perusahaan Pengiriman
if ($module==$module AND $act=='hapus'){
	$id  = $_GET['id'];
	$gbr = $_GET['file'];
	
	$cek = mysql_fetch_array(mysql_query("SELECT gambar FROM mod_news WHERE id_news='$id'"));
	if($cek['gambar']!=''){
	mysql_query("DELETE FROM mod_news WHERE id_news='$id'");
    unlink("../../../joimg/news/$cek[gambar]");   
    unlink("../../../joimg/news/s_$cek[gambar]");
  } else { 
	mysql_query("DELETE FROM mod_news WHERE id_news='$id'");
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
    UploadNews($nama_file_unik);
    mysql_query("INSERT INTO mod_news(judul,
									isi_berita,
									tanggal,
                                    gambar) 
                            VALUES('$_POST[judul]',
									'$_POST[isi_berita]',
									now(),
                                   '$nama_file_unik')");
	}
	else{
		mysql_query("INSERT INTO mod_news(judul,
									isi_berita,
									tanggal) 
                            VALUES('$_POST[judul]',
									'$_POST[isi_berita]',
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
  $sql = mysql_query("SELECT gambar FROM mod_news WHERE id_news='$_POST[id]'");
  $s    	= mysql_fetch_array($sql);
  unlink("../../../joimg/news/$s[gambar]");   
  unlink("../../../joimg/news/s_$s[gambar]");
  UploadNews($nama_file_unik);
  mysql_query("UPDATE mod_news SET judul = '$_POST[judul]', isi_berita = '$_POST[isi_berita]', gambar = '$nama_file_unik'  WHERE id_news = '$_POST[id]'");
  }
  else{
  mysql_query("UPDATE mod_news SET judul = '$_POST[judul]', isi_berita = '$_POST[isi_berita]' WHERE id_news = '$_POST[id]'");
  }
  
  header('location:../../media.php?module='.$module);
}


?>
