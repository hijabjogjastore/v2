<?php
session_start();

include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];
$folderimg="../../../joimg/testimoni/"; // Tempat upload file gambar

// Hapus Perusahaan Pengirima
if ($module==$module AND $act=='hapus'){

	$id  = $_GET['id'];
	mysql_query("DELETE FROM mod_testimoni WHERE id_testimoni='$id'");

	
	header('location:../../media.php?module='.$module);
}

// Input Perusahaan Pengiriman
elseif ($module=="$module" AND $act=='input'){
  
		mysql_query("INSERT INTO mod_testimoni(dari,
									isi_testimoni,
									tanggal,
                  status) 
                            VALUES('$_POST[dari]',
									'$_POST[isi_testimoni]',
									now(),
                  'Y')");
	header('location:../../media.php?module='.$module);

}

// Update Perusahaan Pengiriman
elseif ($module=="$module" AND $act=='update'){



  mysql_query("UPDATE mod_testimoni SET dari = '$_POST[dari]', 
                                        isi_testimoni = '$_POST[isi_testimoni]',
                                        status='$_POST[status]' WHERE id_testimoni = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}


?>
