<script language="javascript">
function validasi(form){
  if (form.nama_news.value == ""){
    alert("Anda belum mengisikan nama Jasa Pengiriman.");
    form.nama_news.focus();
    return (false);
  }
   return (true);
}
</script>
<?php
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else
{
$aksi="modul/mod_news/aksi_news.php";
$module=$_GET['module'];
switch($_GET['act'])
{
  // Tampil Kategori
  default:
    echo "<h2 class='hLine'>News</h2>
          <table class='list'>
		  <tr>
			<td class='left'>
				<input type='button' class='butt' value='Tambah News' onclick=\"window.location.href='?module=$module&act=addNews';\">
			</td>
		  </tr></table>";    
    // Cek jikalau data dalam database kosong
    // Jika kosong
    $sql = mysql_query("SELECT * FROM mod_news");
    $s=mysql_fetch_array($sql);
    if($s['id_news']==0)
    {
		echo"";
    } 
    else 
    {
        // Jika tidak kosong
        echo"<table class='list' id='listTable'>
              <thead>
			  <tr>
				<td class='center'>No.</td>
				<td class='center'>Judul</td>
				<td class='center'>Gambar</td>
				<td class='center'>Tanggal Posting</td>
				<td class='center'>Edit</td>
				<td class='center'>Delete</td>
			 </tr></thead>"; 
        $tampil=mysql_query("SELECT * FROM mod_news ORDER BY id_news DESC");
        $no=1;
        while ($r=mysql_fetch_array($tampil)){
            
            // Kolom Warna
            if(($no%2)==0){
            $warna="ganjil";
            }else{
            $warna="genap";
            }
            // Kolom Warna
            
           echo "<tr class='$warna'>
                 <td width=30px>$no.</td>
                 <td class='left'>$r[judul]</td>
                 <td><img src='../joimg/news/s_$r[gambar]'  /></td>
				 <td class='left'>$r[tanggal]</td>
                 <td class='center' width='50px'><a href=?module=$module&act=editNews&id=$r[id_news]><img src='images/add-icon.gif' title='edit' /></a></td>
    	         <td width='50px'><a href=$aksi?module=$module&act=hapus&id=$r[id_news]&file=$r[gambar]><img src='images/hr.gif' title='hapus' /></a>
                 </td></tr>";
          $no++;
        }
        echo "</table>";
    }
    break;
  
  // Form Tambah Perusahaan Pengiriman
  case "addNews":
    echo "<h2 class='hLine'>Tambah News</h2>
          <form method=POST action='$aksi?module=$module&act=input' enctype='multipart/form-data' onSubmit=\"return validasi(this)\">
          <table class='list'>
          <tr>
			<td class='left' width=150px>Judul</td>
			<td class='left'> : <input type=text name='judul'></td>
		  </tr>
		  <tr>
			<td class='left' width=150px>Isi</td>
			<td class='left'> : <textarea name='isi_berita'  id='jogmce' style='height:400px;'></textarea>
		  </tr>
		  <tr>
			<td class='left'> Gambar </td>
			<td class='left'> : <input type=file name='fupload' size=80> </td>
		 </tr>
		 <tr>
			<td class='left' colspan='2'> * lebar maksimal gambar 400px.</td>
		 </tr>
         <td class='left' colspan=2><input class='butt' type=submit name=submit value=Simpan>
                            <input type=button class='butt' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
  
	// Form Edit Perusahaan Pengiriman  
	case "editNews":
    $edit=mysql_query("SELECT * FROM mod_news WHERE id_news='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit News</h2>
          <form method=POST action='$aksi?module=$module&act=update' enctype='multipart/form-data' onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_news]'>
          <table class='list'>
          <tr>
			<td class='left'>Judul</td>
			<td class='left'> <input type=text name='judul' value='$r[judul]'></td></tr>
		  <tr>
			<td class='left' width=150px>Isi</td>
			<td class='left'> : <textarea name='isi_berita' id='jogmce' style='height:400px;'>$r[isi_berita]</textarea>
		  </tr>
          <tr>
			<td class='left'>Gambar</td>
			<td class='left'> <img src='../joimg/news/$r[gambar]' /></td></tr>
		 <tr>
			<td class='left'>Ganti gambar</td>
			<td class='left'> <input type=file name='fupload' size=80></td></tr>
          <tr>
			<td class='left' colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr>
			<td class='left' colspan=2>
				<input class='butt' type=submit value=Update>
				<input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}

}
?>
