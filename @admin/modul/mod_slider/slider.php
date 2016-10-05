<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_slider/aksi_slider.php";
switch($_GET['act']){
  // Tampil slideshow
  default:
    echo "<h2 class='hLine'>Edit Slide</h2>
          <input type=button  class='butt' value='Tambahkan Slide' onclick=location.href='?module=slider&act=tambahslider'>
          <table class='list'>
          <thead><tr><td class='center' width='70'>No.</td><td class='center'>thumbnail</td><td class='center'>Judul</td><td class='center'>tanggal posting</td><td class='center' colspan='2'>Aksi</td></tr></thead>";
    $tampil=mysql_query("SELECT * FROM mod_slider ORDER BY id_slider DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
    $tgl_posting=tgl_indo($r['tgl_posting']);  
      echo "<tr><td>$no.</td>
                <td><img src='../assets/images/slide/$r[gambar]' width='480' height='310' /></td>
                <td class='left'>$r[judul]</td>
                <td>$tgl_posting</td>
				<td>
				<a href=?module=slider&act=editslider&id=$r[id_slider]><img src='images/add-icon.gif' title='edit'></a>
				</td>
				<td>
				<a href=$aksi?module=slider&act=hapus&id=$r[id_slider]&namafile=$r[gambar]><img src='images/hr.gif' title='hapus'></a>
		        </td></tr>";
    $no++;
    }
    echo "</table>";
    break;
  
  case "tambahslider":
    echo "<h2 class='hLine'>Tambahkan Slide</h2>
          <form method=POST action='$aksi?module=slider&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td class='left'>Judul</td>
			<td class='left'><input type=text name='judul' size=30></td>
		  </tr>
         <tr>
			<td class='left'>Gambar</td>
			<td class='left'><input type=file name='fupload' size=40></td></tr>
		  <tr>
			<td class='left' colspan=2>* Ukuran foto slide: <strong><u>480x325 px</u></strong>, Format *.JPEG/JPG</td></tr>
          <tr>
			<td class='left' colspan=2>
		  <input type=submit class=butt value=Simpan>
          <input type=button class=butt value=Batal onclick=self.history.back()></td>
		  </tr>
          </table></form>";
     break;
    
  case "editslider":
    $edit = mysql_query("SELECT * FROM mod_slider WHERE id_slider='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Slide</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=slider&act=update>
          <input type=hidden name=id value=$r[id_slider]>
          <table class='list'>
          <tr>
			<td class='left'>Judul</td>
			<td class='left'><input type=text name='judul' size=30 value='$r[judul]'></td>
		</tr>
        <tr>
			<td class='left'>Gambar</td>
			<td class='left'><img  src='../assets/images/slide/$r[gambar]'></td></tr>
        <tr>
			<td class='left'>Ganti Gambar</td>
			<td class='left'><input type=file name='fupload' size=30> *)</td>
		</tr>
        <tr>
			<td class='left' colspan=2>*) File gambar (jpg/jpeg) dengan ukuran <strong><u>480x325 pixel</u></strong>. Apabila gambar tidak diubah, dikosongkan saja.</td>
		</tr>
        <tr>
			<td class='left' colspan=2>
			<input type=submit class=butt value=Update>
            <input type=button class=butt value=Batal onclick=self.history.back()></td>
		</tr>
        </table></form>";
    break;  
}
}
?>
