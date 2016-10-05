<script language="javascript">
function validasi(form){
  if (form.nama_galeri.value == ""){
    alert("Anda belum mengisikan nama Jasa Pengiriman.");
    form.nama_galeri.focus();
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
$aksi="modul/mod_galeri/aksi_galeri.php";
$module=$_GET['module'];
switch($_GET['act'])
{
  // Tampil Kategori
  default:
    echo "<h2 class='hLine'>Galeri</h2>
          <table class='list'>
		  <tr>
			<td class='left'>
				<input type='button' class='butt' value='Tambah Galeri' onclick=\"window.location.href='?module=$module&act=addGaleri';\">
			</td>
		  </tr></table>";    
    // Cek jikalau data dalam database kosong
    // Jika kosong
    $sql = mysql_query("SELECT * FROM galeri");
    $s=mysql_fetch_array($sql);
    if($s['id_galeri']==0)
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
        $tampil=mysql_query("SELECT * FROM galeri ORDER BY id_galeri DESC");
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
                 <td><img src='../joimg/galeri/s_$r[gambar]'  /></td>
				 <td class='left'>$r[tanggal]</td>
                 <td class='center' width='50px'><a href=?module=$module&act=editGaleri&id=$r[id_galeri]><img src='images/add-icon.gif' title='edit' /></a></td>
    	         <td width='50px'><a href=$aksi?module=$module&act=hapus&id=$r[id_galeri]&file=$r[gambar]><img src='images/hr.gif' title='hapus' /></a>
                 </td></tr>";
          $no++;
        }
        echo "</table>";
    }
    break;
  
  // Form Tambah Perusahaan Pengiriman
  case "addGaleri":
    echo "<h2 class='hLine'>Tambah Galeri</h2>
          <form method=POST action='$aksi?module=$module&act=input' enctype='multipart/form-data' onSubmit=\"return validasi(this)\">
          <table class='list'>
          <tr>
			<td class='left' width=150px>Judul</td>
			<td class='left'> : <input type=text name='judul'></td>
		  </tr>
		  <tr>
		  <td class='left'>Pilih Album</td>
		  <td class='left'>
		  : <select name='id_album'>
   <option value=0 selected>Pilih Kategori</option>";
   $tampil=mysql_query("SELECT * FROM album ORDER BY judul");
   while($r=mysql_fetch_array($tampil)){
   echo "<option value=$r[id_album]>$r[judul]</option></p>"; }
   echo "</select></td></tr>";
   echo"
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
	case "editGaleri":
    $edit=mysql_query("SELECT * FROM galeri WHERE id_galeri='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Galeri</h2>
          <form method=POST action='$aksi?module=$module&act=update' enctype='multipart/form-data' onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_galeri]'>
          <table class='list'>
          <tr>
			<td class='left'>Judul</td>
			<td class='left'> <input type=text name='judul' value='$r[judul]'></td></tr>
			<tr>
			<td class='left'>Pilih Album</td>
			<td class='left'>
			<select name='id_album'>";
		   $tampil=mysql_query("SELECT * FROM album ORDER BY judul");
		   if ($r[id_album]==0){
		   echo "<option value=0 selected>- Pilih Album -</option>"; }   
		
		   while($w=mysql_fetch_array($tampil)){
		   if ($r[id_album]==$w[id_album]){
		   echo "<option value=$w[id_album] selected>$w[judul]</option>";}
		   else{
		   echo "<option value=$w[id_album]>$w[judul]</option> </p> ";}}
		
		   echo "</select>";
		   echo"
			</td>
			</tr>
          <tr>
			<td class='left'>Gambar</td>
			<td class='left'> <img src='../joimg/galeri/$r[gambar]' /></td></tr>
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
