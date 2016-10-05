<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else
{
	include "../../../josys/koneksi.php";
	include "../../../josys/library.php";
	include "../../../josys/fungsi_thumb.php";

	$module=$_GET['module'];
	$act=$_GET['act'];

	// Hapus halaman statis
	if ($module=='page' AND $act=='hapus'){
	  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM mod_page WHERE id_page='$_GET[id]'"));
	  if ($data['gambar']!=''){
		 mysql_query("DELETE FROM mod_page WHERE id_page='$_GET[id]'");
	  }
	  else{
		 mysql_query("DELETE FROM mod_page WHERE id_page='$_GET[id]'");
	  }
	  header('location:../../media.php?module='.$module);
	}//end delete

	// Input halaman statis
	elseif ($module=='page' AND $act=='input'){

		$keyword 	    = trim($_POST['keyword']);
		$meta_deskripsi = strip_tags(trim($_POST['meta_deskripsi']));
		
		mysql_query("INSERT INTO mod_page(judul,
										isi,
										meta_keyword,
										meta_deskripsi,
										tgl_posting) 
								VALUES('$_POST[judul]',
									   '$_POST[isi_halaman]',
									   '$keyword',
									   '$meta_deskripsi',
									   '$tgl_sekarang')");
		header('location:../../media.php?module='.$module);
	}//end input

	// Update halaman statis
	elseif ($module=='page' AND $act=='update')
	{
		$keyword = trim($_POST['keyword']);
		$meta_deskripsi = strip_tags(trim($_POST['meta_deskripsi']));  
		$gmap = $_POST['gmap'];
		
		mysql_query("UPDATE mod_page SET judul  = '$_POST[judul]', 
												  meta_keyword    = '$keyword',
												  meta_deskripsi  = '$meta_deskripsi',
												  isi 	  	    = '$_POST[isi_halaman]'
											WHERE id_page  = '$_POST[id]'") or die(mysql_error());
											
		if ($_POST['id']=='1' OR $_POST['id']=='6' OR $_POST['id']=='8')
		{
				header('location:../../media.php?module=home');
		}
		else 
		{
			if($_POST['id']=='5')
			{	mysql_query("UPDATE mod_page SET extra  = '$gmap'
										 WHERE id_page  = '$_POST[id]'") or die(mysql_error());
			}
			header('location:../../media.php?module=page&act=edit&id='.$_POST[id]);
		}
	}//end update
}
?>
