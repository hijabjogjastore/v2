<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
 echo "<script>window.alert('Untuk mengakses modul anda harus login!');window.location=('../../index.php');</script>";
}
else {
$aksi="modul/mod_download/aksi_download.php";
switch($_GET['act']){
  // Tampil Banner
  default:
    echo "<h2 class='hLine'>Edit download</h2>
          <input class='butt' type=button value='Tambah Download' onclick=location.href='?module=download&act=tambahdownload'>
          <table class='list'>
          <thead>
		  <tr><td class='center' width='50'>no.</td>
		  <td class='center'>thumbnail</td>
		  <td class='center'>isi</td>
		  <td class='center' colspan='2'>aksi</td></tr></thead>";
		   
    $tampil=mysql_query("SELECT * FROM mod_download ORDER BY id DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no.</td>
				<td>$r[gambar]</td>
                <td class='left'>$r[nama]</td>
                <td><a href=?module=download&act=editdownload&id=$r[id]><img src='images/add-icon.gif' title='edit'></a></td>
	        	<td><a href=$aksi?module=download&act=hapus&id=$r[id]><img src='images/hr.gif' title='edit'></a></td>
		        </tr>";
    $no++;
    }
	echo "</table>";  
    break;
  
  case "tambahdownload":
    echo "<h2 class='hLine'><a href=?module=download>Download</a></h2>
          <form method=POST action='$aksi?module=download&act=input' enctype='multipart/form-data'>
          <input type=hidden name='url' size=80 value='http://www.' >
          <table class='list'>
          <tr>
		  <td class='left'>Judul</td>
		  <td class='left'>  : <input type=text name='judul' size=80></td></tr>
          <tr>
		  <td class='left'>File</td>
		  <td class='left'> : <input type=file name='fupload' size=80> *</td></tr>
          <tr>
		  </tr>
		  <tr>
		  <td class='left' colspan=2>
		  <input class='butt' type=submit value=Simpan>
          <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br><br>";
     break;
    
  case "editdownload":
    $edit = mysql_query("SELECT * FROM mod_download WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2><a href='?module=$_GET[module]'>Edit Download</a> &raquo; $r[nama]</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=download&act=update>
          <input type=hidden name='url' size=50 value='$r[link]'>
          <input type=hidden name=idsosial value=$r[id]>
          <table class='list'>
          <tr><td class='left'>Judul</td>
		  <td class='left'> <input type=text name='judul' size=30 value='$r[nama]'></td></tr>
          <tr><td class='left'>File</td>
		  <td class='left'>$r[gambar]</td></tr>
          <tr><td class='left'>Ubah File</td>
		  <td class='left'> <input type=file name='fupload' size=30> *)</td></tr>
		  
          <tr><td colspan=2 class='left'><input class='butt' type=submit value=Update>
                            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}//end switch

}//end else
?>
