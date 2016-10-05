<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else
{
		$aksi="modul/mod_ongkir/aksi_ongkir.php";
	switch($_GET[act]){
	// Tampil Ongkos Kirim
	default:
		echo "<h2 class='hLine'>Ongkos Kirim</h2>
			  <input class='butt' type=button value='Tambah Ongkos Kirim' 
			  onclick=\"window.location.href='?module=ongkir&act=tambahongkoskirim';\">
			  <table class='list'>
			  <thead>
			  <tr>
			  	<td class='center'>no.</td>
			  	<td class='center'>nama kota</td>
			  	<td class='center'>ongkos kirim (Rp.)</td>
			  	<td class='center'>aksi</td>
			  </tr></thead>"; 
		
		$tampil=mysql_query("SELECT * FROM kota ORDER BY id_kota DESC");
		$no=1;
		while ($r=mysql_fetch_array($tampil))
		{
			$ongkos = format_rupiah($r[ongkos_kirim]);
			echo "<tr>
					<td>$no.</td>
				  	<td>$r[nama_kota]</td>
				  	<td align=right>Rp. $ongkos,-</td>
				  	<td><a href=?module=ongkir&act=editongkoskirim&id=$r[id_kota]>Edit</a> | 
					  <a href=$aksi?module=ongkir&act=hapus&id=$r[id_kota]>Hapus</a>
				  	</td>
				  </tr>";
			$no++;
		}
		echo "</table>";
		echo "<input class='butt' type=button value='Back' onclick=location.href='?module=home'>";
		break;
  
	// Form Tambah Ongkos Kirim
	case "tambahongkoskirim":
		echo "<h2 class='hLine'>Tambah Ongkos Kirim</h2>
			  <form method=POST action='$aksi?module=ongkir&act=input'>
			  <table class='list'>
			  <tr><td class='left'>Nama Kota</td><td class='left'> : <input size='60' class='msgBox' type=text name='nama_kota'></td></tr>
			  <tr>
			  	<td class='left'>Ongkos Kirim</td>
			  	<td class='left'> : <input class='msgBox' size='60' type=text name='ongkos_kirim' size=7>
			  		<i>* tanpa tanda titik(.) cth: 12500</i>
			  	</td>
			  </tr>
		      <tr><td colspan='2' class='left'>
		      	<input class='butt' type=submit name=submit value=Simpan>
				<input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
			  </table></form>";
		break;
  
	// Form Edit Ongkos Kirim
	case "editongkoskirim":
		$edit=mysql_query("SELECT * FROM kota WHERE id_kota='$_GET[id]'");
		$r=mysql_fetch_array($edit);

		echo "<h2 class='hLine'>Edit Ongkos Kirim</h2>
			  <form method=POST action=$aksi?module=ongkir&act=update>
			  <input type=hidden name=id value='$r[id_kota]'>
			  <table class='list'>
			  <tr>
			  	<td class='left'>Nama Kota</td>
			  	<td class='left'> : <input class='msgBox' size='60' type=text name='nama_kota' value='$r[nama_kota]'></td></tr>
			  <tr>
			  	<td class='left'>Ongkos Kirim</td>
			  	<td class='left'> : <input class='msgBox' size='60' type=text name='ongkos_kirim' value='$r[ongkos_kirim]' size=7>
			  		<i>* tanpa tanda titik(.) cth: 12500</i>
			  	</td></tr>
			  <tr><td colspan='2' class='left'>
			  	<input class='butt' type=submit value=Update>
				<input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
			  </table></form>";
		break;  
	}
}