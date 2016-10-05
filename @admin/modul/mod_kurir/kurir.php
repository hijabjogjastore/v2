<script language="javascript">
function validasi(form){
  if (form.nama_kurir.value == ""){
    alert("Anda belum mengisikan nama Jasa Pengiriman.");
    form.nama_kurir.focus();
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
$aksi="modul/mod_kurir/aksi_kurir.php";
$module=$_GET['module'];
switch($_GET['act'])
{
  // Tampil Kategori
  default:
    echo "<h2 class='hLine'>Jasa Pengiriman Barang</h2>
          <table class='list'>
		  <tr>
			<td class='left'>
				<input type='button' class='butt' value='Tambah Jasa Pengiriman' onclick=\"window.location.href='?module=$module&act=addKurir';\">
			</td>
		  </tr></table>";    
    // Cek jikalau data dalam database kosong
    // Jika kosong
    $sql = mysql_query("SELECT * FROM mod_kurir");
    $s=mysql_fetch_array($sql);
    if($s['id_kurir']==0)
    {
		echo"";
    } 
    else 
    {
        // Jika tidak kosong
        echo"<table class='list'>
              <thead>
			  <tr>
				<td class='center'>No.</td>
				<td class='center'>Nama Jasa Pengiriman</td>
				<td class='center'>Link</td>
				<td class='center'>Logo</td>
				<td class='center' colspan='2'></td>
			 </tr></thead>"; 
        $tampil=mysql_query("SELECT * FROM mod_kurir ORDER BY id_kurir DESC");
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
                 <td class='left'>$r[nama_kurir]</td>
                 <td class='left'><a href=http://www.$r[link] target=_blank>$r[link]</a></td>
                 <td><img src='../assets/images/shipping/$r[gambar]'  /></td>
                 <td class='center' width='50px'><a href=?module=$module&act=editKurir&id=$r[id_kurir]><img src='images/add-icon.gif' title='edit' /></a></td>
    	         <td width='50px'><a href=$aksi?module=$module&act=hapus&id=$r[id_kurir]&file=$r[gambar]><img src='images/hr.gif' title='hapus' /></a>
                 </td></tr>";
          $no++;
        }
        echo "</table>";
    }
    break;
  
  // Form Tambah Perusahaan Pengiriman
  case "addKurir":
    echo "<h2 class='hLine'>Tambah Perusahaan Pengiriman Barang</h2>
          <form method=POST action='$aksi?module=$module&act=input' enctype='multipart/form-data' onSubmit=\"return validasi(this)\">
          <table class='list'>
          <tr>
			<td class='left' width=150px>Nama Jasa Pengiriman</td>
			<td class='left'> : <input type=text name='nama_kurir'></td>
		  </tr>
		  <tr>
			  <td class='left'>Link</td>
			  <td class='left'>   : <input type=text name='link' size=80 value='http://www.' ></td>
		  </tr>
		 <tr>
			<td class='left'> Logo </td>
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
	case "editKurir":
    $edit=mysql_query("SELECT * FROM mod_kurir WHERE id_kurir='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Jasa Pengiriman Barang</h2>
          <form method=POST action='$aksi?module=$module&act=update' enctype='multipart/form-data' onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_kurir]'>
          <table class='list'>
          <tr>
			<td class='left'>Nama Jasa Pengiriman</td>
			<td class='left'> <input type=text name='nama_kurir' value='$r[nama_kurir]'></td></tr>
          <tr>
			<td class='left'>Logo</td>
			<td class='left'> <img src='../assets/images/shipping/$r[gambar]' /></td></tr>
		  <tr><td class='left'>Link</td>
			<td class='left'>  <input type=text name='link' size=50 value='$r[link]'></td></tr>
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
