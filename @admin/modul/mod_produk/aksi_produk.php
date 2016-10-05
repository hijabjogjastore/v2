<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";
include "../../../josys/fungsi_input.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus produk
if ($module=='produk' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM produk WHERE id_produk='$_GET[id]'"));
  if($data['gambar']!='') {
	
	//hapus foto dari folder
	unlink("../../../joimg/produk/$data[gambar]");
	unlink("../../../joimg/produk/s_$data[gambar]");
	mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
	header('location:../../media.php?module='.$module);
  
  } 
	else {

	mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
	header('location:../../media.php?module='.$module);

	}
 
}

// Input produk
elseif ($module=='produk' AND $act=='input')
{
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $produk_seo  = seo_title($_POST['nama_produk']);

  if(empty($_POST['nama_produk']))
  {
	echo "<script>window.alert('Nama Produk harus diisi!');
    window.location=('../../media.php?module=produk&act=tambahproduk')</script>";
  }
  elseif(empty($_POST['kategori']))
  {
	echo "<script>window.alert('Anda Belum memilih kategori produk!');</script>";
  }
  else 
  {
	  // Apabila ada gambar yang diupload
	  if (!empty($lokasi_file))
	  {
	  	$tipe_file      = $_FILES['fupload']['type'];
		$nama_file      = $_FILES['fupload']['name'];
		$acak           = rand(1,99);
		$nama_file_unik = $acak.$nama_file; 
		UploadImage($nama_file_unik);
		mysql_query("INSERT INTO produk(nama_produk,
	                                    produk_seo,
	                                    id_kategori,
	                                    harga,
	                                    deskripsi,
	                                    tgl_masuk,
	                                    gambar) 
	                            VALUES('$_POST[nama_produk]',
	                                   '$produk_seo',
	                                   '$_POST[kategori]',
	                                   '$_POST[harga]',
	                                   '$_POST[deskripsi]',
	                                   '$tgl_sekarang',
	                                   '$nama_file_unik')");
		$idp = mysql_insert_id();
	  }
	  else 
	  {
		mysql_query("INSERT INTO produk(nama_produk,
                                    produk_seo,
                                    id_kategori,
                                    harga,
                                    deskripsi,
                                    tgl_masuk) 
                            VALUES('$_POST[nama_produk]',
                                   '$produk_seo',
                                   '$_POST[kategori]',
                                   '$_POST[harga]',
                                   '$_POST[deskripsi]',
                                   '$tgl_sekarang')")or die(mysql_error());
		$idp = mysql_insert_id();
	  }
	header('location:../../media.php?module='.$module);
  }
}

// Update produk
elseif ($module=='produk' AND $act=='update')
{
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  $produk_seo      = seo_title($_POST[nama_produk]);
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',
                                   produk_seo  = '$produk_seo', 
                                   id_kategori = '$_POST[kategori]',
								   id_subkategori = '$_POST[subkategori]',
                                   harga       = '$_POST[harga]',
                                   deskripsi   = '$_POST[deskripsi]',
								   special	   = '$_POST[special]'
                             WHERE id_produk   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  }
  else
  {
	$data=mysql_fetch_array(mysql_query("SELECT gambar FROM produk WHERE id_produk='$_POST[id]'"));
	if($data['gambar']!='') 
	{
	//hapus foto dari folder
	unlink("../../../joimg/produk/$data[gambar]");
	unlink("../../../joimg/produk/s_$data[gambar]");
	
    UploadImage($nama_file_unik);
    mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',
                                   produk_seo  = '$produk_seo', 
                                   id_kategori = '$_POST[kategori]',
                                   id_subkategori = '$_POST[subkategori]',
                                   harga       = '$_POST[harga]',
                                   deskripsi   = '$_POST[deskripsi]',
								   special	   = '$_POST[special]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_produk   = '$_POST[id]'");
		header('location:../../media.php?module='.$module);
    }
    else 
    {
		    UploadImage($nama_file_unik);
			mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',
                                   produk_seo  = '$produk_seo', 
                                   id_kategori = '$_POST[kategori]',
                                   id_subkategori = '$_POST[subkategori]',
                                   harga       = '$_POST[harga]',
                                   deskripsi   = '$_POST[deskripsi]',
                                   gambar      = '$nama_file_unik', 
                                   special     = '$_POST[special]' 
                             WHERE id_produk   = '$_POST[id]'")or die(mysql_error());
			header('location:../../media.php?module='.$module);
	}
  }
}

//update promo
elseif($module=='produk' AND $act=='updatePromo')
{
	$id 	= $_GET['id'];
	$stat	= $_GET['stat'];
	//update promo status
	if($stat=='N') {
		mysql_query("UPDATE produk SET special='Y' WHERE id_produk='$id'");
	} else { mysql_query("UPDATE produk SET special='N' WHERE id_produk='$id'"); }
	header('location:../../media.php?module='.$module);
}

//update laris
elseif($module=='produk' AND $act=='updateLaris')
{
	$id   = $_GET['id'];
	$stat = $_GET['stat'];
	if($stat=='N')
	{
		mysql_query("UPDATE produk SET terlaris='Y' WHERE id_produk='$id'");
	}
	else
	{
		mysql_query("UPDATE produk SET terlaris='N' WHERE id_produk='$id'");
	}
	header('location:../../media.php?module='.$module);
}

?>