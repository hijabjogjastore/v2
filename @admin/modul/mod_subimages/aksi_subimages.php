<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	include "../../../josys/koneksi.php";
	include "../../../josys/fungsi_thumb.php";
	include "../../../josys/watermark.php";

	$module=$_GET['module'];
	$act=$_GET['act'];

	// Update subimages
	if ($module=='subimages' AND $act=='update'){
	  
		$lokasi_file    = $_FILES['fupload']['tmp_name'];
		$tipe_file      = $_FILES['fupload']['type'];
		$nama_file      = $_FILES['fupload']['name'];
		$acak           = rand(000000,999999);
		$nama_file_unik = $acak.$nama_file; 
	  
		if(!empty($lokasi_file)){	  
			$tampil=mysql_query("SELECT * FROM subimages WHERE id='$_POST[id]'");
			$ex=mysql_fetch_array($tampil);
			if($ex['gambar'] != ''){
				unlink("../../../assets/images/subimages/$ex[gambar]");
			}
			
			UploadSubimages($nama_file_unik);
		  
			mysql_query("UPDATE subimages SET 	judul 	= '$_POST[judul]',product_id 	= '$_POST[product_id]',
											gambar	= '$nama_file_unik'
									WHERE id  = '$_POST[id]'");
		}else{
			mysql_query("UPDATE subimages SET 	judul 	= '$_POST[judul]', product_id 	= '$_POST[product_id]'
								WHERE id  = '$_POST[id]'");
		}
		header('location:../../media.php?module='.$module.'&id='.$ex['product_id']);
	}
	// Update Hapus Message
	/*if ($module=='subimages' AND $act=='hapus'){	  
		$tampil=mysql_query("SELECT * FROM subimages WHERE id='$_GET[id]'");
		$ex=mysql_fetch_array($tampil);
		
		if($ex['gambar'] != ''){
			unlink("../../../joimg/subimages/$ex[gambar]");
			mysql_query("DELETE FROM subimages WHERE id='$_GET[id]'");
		}else {
			mysql_query("DELETE FROM subimages WHERE id='$_GET[id]'");
		}
		header('location:../../media.php?module='.$module.'&id='.$ex['id_produk']);
	}*/


// Hapus subimages
if ($module=='subimages' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM subimages WHERE id='$_GET[id]'"));
  if($data['gambar']!='') {
	
	//hapus foto dari folder
	unlink("../../../assets/images/subimages/$data[gambar]");
	mysql_query("DELETE FROM subimages WHERE id='$_GET[id]'");
	header('location:../../media.php?module='.$module.'&id='.$_POST['product_id']);
  
  } 
	else {

	mysql_query("DELETE FROM subimages WHERE id='$_GET[id]'");
	header('location:../../media.php?module='.$module.'&id='.$_POST['product_id']);
	}
}	



	// Update Tambah subimages
	if ($module=='subimages' AND $act=='insertnew'){  
	  
		$x=count ($_FILES['fupload']['tmp_name']);
		$lokasi_file    = $_FILES['fupload']['tmp_name'];
		if(!empty($lokasi_file)){	    
			for($i=0;$i<$x;$i++){
				$lokasi_file    = $_FILES['fupload']['tmp_name'][$i];
				$tipe_file      = $_FILES['fupload']['type'][$i];
				$nama_file      = $_FILES['fupload']['name'][$i];
				$acak           = rand(000000,999999);
				$nama_file_unik = $acak.$nama_file; 
  
				UploadSubimages($nama_file_unik,$i);
				//watermark_image("../../../joimg/subimages/$nama_file_unik", "../../../joimg/subimages/$nama_file_unik");
		  
				mysql_query("INSERT INTO subimages(judul,product_id,
											gambar,tanggal) 
									VALUES('$_POST[judul]','$_POST[product_id]',
											'$nama_file_unik',now() )");
											//echo $sql; exit;
			}
		}else{
			mysql_query("INSERT INTO subimages(judul,product_id,tanggal) 
								VALUES('$_POST[judul]','$_POST[product_id]',now() )");
		}
		header('location:../../media.php?module='.$module.'&id='.$_POST['product_id']);
	}

}
?>
