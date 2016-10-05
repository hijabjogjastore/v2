<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_page/aksi_page.php";
switch($_GET['act'])
{
  // Tampil Halaman Statis
  default:
    echo "<h2 class='hLine'>Pengaturan Halaman</h2>
           <input class='butt' type=button value='Tambah Halaman' onclick=\"window.location.href='?module=page&act=add';\">
          <table class='list'>
          <tr><td>No.</td><td>Judul</td><td>Tgl. Posting</td><td>Link Halaman</td><td colspan='2'>Aksi</td></tr>";

    $tampil = mysql_query("SELECT * FROM mod_page WHERE id_page !='1' AND statis='Y' ORDER BY id_page DESC");
    $no = 1;
    while($r=mysql_fetch_array($tampil)){
	
	// membuat link untuk halaman statis
      $huruf_kecil  = strtolower($r['judul']);
      $pisah_huruf  = explode(" ",$huruf_kecil);
      $gabung_huruf = implode("",$pisah_huruf);
      
      $tgl_posting=tgl_indo($r['tgl_posting']);
      echo "<tr><td>$no</td>
                <td class='left'>$r[judul]</td>
                <td class='left'>$tgl_posting</td>
                <td class='left'>page-$r[id_page]-$gabung_huruf.html</td>
			
		            <td width='50'><a href=?module=page&act=edit&id=$r[id_page] title='edit'><img src='images/add-icon.gif'></a> </td> 
		            <td width='50'><a href='$aksi?module=page&act=hapus&id=$r[id_page]&namafile=$r[gambar]' title='hapus'><img src='images/hr.gif'></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
    break;

  case "add":
    echo "<h2 class='hLine'>Tambah Halaman</h2>
          <form method=POST action='$aksi?module=page&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td class='left'>Judul</td>
			<td class='left'> : <input type=text name='judul' size=60></td></tr>
          <tr>
			<td>Isi Halaman</td>  <td> <textarea name='isi_halaman'  id='jogmce' style='height:400px;'></textarea></td></tr>
		  <tr>
			<td class='left'>SEO Keyword</td>
			<td class='left'>: <input type='text' name='keyword' class='msgBox'  size='60'></td>
		  </tr>
		<tr><td class='left' colspan=2>
			<input class='butt' type=submit value=Simpan>
            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "edit":
    $edit = mysql_query("SELECT * FROM mod_page WHERE id_page='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "<h2 class='hLine'>Edit Halaman &raquo $r[judul]</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=page&act=update>
          <input type=hidden name=id value=$r[id_page]>
          <table class='list'>";
    echo "<tr>
	<td  class='left' valign='middle' width=80>Judul</td> 
	<td class='left'> : <input type=text name='judul' size=60 value='$r[judul]'> </td>
	</tr>";	
	
	echo "<tr>
		<td>Isi Halaman</td>   
		<td> <textarea name='isi_halaman' id='jogmce' style='height:400px;'>$r[isi]</textarea></td>
	</tr>
	<tr>
		<td class='center' > SEO Description</td>
		<td class='left'>
			<textarea name='meta_deskripsi' class='msgBox'>$r[meta_deskripsi]</textarea>
		</td>
	</tr>
	<tr>
		<td class='left'>SEO Keyword</td>
		<td class='left'>"; if($r['meta_keyword']!='') {
			echo "<input type='text' name='keyword' class='msgBox'  value='$r[meta_keyword]' size='100'>";
		} else { 
				echo "<input type='text' name='keyword' class='msgBox'  value='Isi Keyword Disini' size='100'>"; 
			}
		echo"</td>
	</tr>";
	if($_GET['id']=="5")
	{
		echo "<tr><td valign='top' class='left'>Google Map Iframe</td>
		<td class='left'><textarea name='gmap' style='height:200px;width:90%;'>$r[extra]</textarea></td></tr>";
	}
	echo "<tr>
			<td class='left' colspan=2>
			<input class='butt' type=submit value=Update>
            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break; 

}//end switch

}//end if-else
?>
