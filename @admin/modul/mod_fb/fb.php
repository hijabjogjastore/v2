<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
 echo "<script>window.alert('Untuk mengakses modul anda harus login!');window.location=('../../index.php');</script>";
}
else {
$aksi="modul/mod_fb/aksi_fb.php";
switch($_GET['act']){
  // Tampil Banner
  default:
    echo "<h2 class='hLine'>Link Facebook</h2>
          <input class='butt' type=button value='Tambah link' onclick=location.href='?module=fb&act=tambahsosial'>
          <table class='list'>
          <thead>
		  <tr><td class='center' width='50'>no.</td>
		  <td class='center'>thumbnail</td>
		  <td class='center'>judul</td>
		  <td class='center'>url</td>
		  <td class='center' colspan='2'>aksi</td></tr></thead>";
		   
    $tampil=mysql_query("SELECT * FROM mod_fb ORDER BY id DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no.</td>
				<td><img src='../joimg/$r[gambar]' width='22' height='22'></td>
                <td class='left'>$r[nama]</td>
                <td class='left'><a href=http://www.$r[link] target=_blank>$r[link]</a></td>
                <td><a href=?module=fb&act=editsosial&id=$r[id]><img src='images/add-icon.gif' title='edit'></a></td>
	        	<td><a href=$aksi?module=fb&act=hapus&id=$r[id]><img src='images/hr.gif' title='edit'></a></td>
		        </tr>";
    $no++;
    }
	echo "</table>";  
    break;
  
  case "tambahsosial":
    echo "<h2 class='hLine'><a href=?module=fb>Link Jejaring Facebook</a></h2>
          <form method=POST action='$aksi?module=fb&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
		  <td class='left'>Judul</td>
		  <td class='left'>  : <input type=text name='judul' size=80></td></tr>
          <tr>
		  <td class='left'>Url</td>
		  <td class='left'>   : <input type=text name='url' size=80 value='http://www.' ></td></tr>
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
    
  case "editsosial":
    $edit = mysql_query("SELECT * FROM mod_fb WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2><a href='?module=$_GET[module]'>Edit Facebook</a> &raquo; $r[nama]</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=fb&act=update>
          <input type=hidden name=idsosial value=$r[id]>
          <table class='list'>
          <tr><td class='left'>Judul</td>
		  <td class='left'> <input type=text name='judul' size=30 value='$r[nama]'></td></tr>
          <tr><td class='left'>Url</td>
		  <td class='left'>  <input type=text name='url' size=50 value='$r[link]'></td></tr>
          <tr><td class='left'>Gambar</td>
		  <td class='left'> <img src='../joimg/$r[gambar]' width='22' height='22' /></td></tr>
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
