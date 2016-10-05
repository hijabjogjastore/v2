<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
 echo "<script>window.alert('Untuk mengakses modul anda harus login!');window.location=('../../index.php');</script>";
}
else {
$aksi="modul/mod_information/aksi_information.php";
switch($_GET['act']){
  // Tampil Banner
  default:
    echo "<h2 class='hLine'>Edit information</h2>
          <input class='butt' type=button value='Tambah link' onclick=location.href='?module=information&act=tambahinformation'>
          <table class='list'>
          <thead>
		  <tr><td class='center' width='50'>no.</td>
		  <td class='center'>thumbnail</td>
		  <td class='center'>isi</td>
		  <td class='center' colspan='2'>aksi</td></tr></thead>";
		   
    $tampil=mysql_query("SELECT * FROM mod_information ORDER BY id DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no.</td>
				<td><img src='../assets/images/information/$r[gambar]' width='50' height='50'></td>
                <td class='left'>$r[nama]</td>
                <td><a href=?module=information&act=editinformation&id=$r[id]><img src='images/add-icon.gif' title='edit'></a></td>
	        	<td><a href=$aksi?module=information0&act=hapus&id=$r[id]><img src='images/hr.gif' title='edit'></a></td>
		        </tr>";
    $no++;
    }
	echo "</table>";  
    break;
  
  case "tambahinformation":
  echo "Hallo";
    echo "<h2 class='hLine'><a href=?module=information>Link Jejaring Sosial</a></h2>
          <form method=POST action='$aksi?module=information&act=input' enctype='multipart/form-data'>
          <input type=hidden name='url' size=80 value='http://www.' >
          <table class='list'>
          <tr>
		  <td class='left'>Judul</td>
		  <td class='left'>  : <input type=text name='judul' size=80></td></tr>
          <tr>
		  <td class='left'>Gambar</td>
		  <td class='left'> : <input type=file name='fupload' size=80> *</td></tr>
          <tr>
			<td class='left' colspan='2'>* Ukuran gambar 32x32 pixel, Format *.jpeg/jpg, *.png</td>
		  </tr>
		  <tr>
		  <td class='left' colspan=2>
		  <input class='butt' type=submit value=Simpan>
          <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br><br>";
     break;
    
  case "editinformation":
    $edit = mysql_query("SELECT * FROM mod_information WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2><a href='?module=$_GET[module]'>Edit Sosial Media</a> &raquo; $r[nama]</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=information&act=update>
          <input type=hidden name='url' size=50 value='$r[link]'>
          <input type=hidden name=idsosial value=$r[id]>
          <table class='list'>
          <tr><td class='left'>Judul</td>
		  <td class='left'> <input type=text name='judul' size=30 value='$r[nama]'></td></tr>
          <tr><td class='left'>Gambar</td>
		  <td class='left'> <img src='../assets/images/information/$r[gambar]' width='22' height='22' /></td></tr>
          <tr><td class='left'>Ganti Gbr</td>
		  <td class='left'> <input type=file name='fupload' size=30> *)</td></tr>
		  <tr><td class='left' colspan='2'>*) Ukuran gambar 32x32 pixel, Format *.jpeg/jpg, *.png <br />Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2 class='left'><input class='butt' type=submit value=Update>
                            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}//end switch

}//end else
?>
