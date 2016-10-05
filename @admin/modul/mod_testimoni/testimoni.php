<script language="javascript">
function validasi(form){
  if (form.nama_testimoni.value == ""){
    alert("Anda belum mengisikan nama Jasa Pengiriman.");
    form.nama_testimoni.focus();
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
$aksi="modul/mod_testimoni/aksi_testimoni.php";
$module=$_GET['module'];
switch($_GET['act'])
{
  // Tampil Kategori
  default:
    echo "<h2 class='hLine'>Testimoni</h2>
          <table class='list'>
		  <tr>
			<td class='left'>
				<input type='button' class='butt' value='Tambah Testimoni' onclick=\"window.location.href='?module=$module&act=addTestimoni';\">
			</td>
		  </tr></table>";    
    // Cek jikalau data dalam database kosong
    // Jika kosong
    $sql = mysql_query("SELECT * FROM mod_testimoni");
    $s=mysql_fetch_array($sql);
    if($s['id_testimoni']==0)
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
				<td class='center'>Dari</td>
				<td class='center'>Pesan</td>
        <td class='center'>Status</td>
				<td class='center'>Edit</td>
				<td class='center'>Delete</td>
			 </tr></thead>"; 
        $tampil=mysql_query("SELECT * FROM mod_testimoni ORDER BY id_testimoni DESC");
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
                 <td class='left'><b>$r[dari]</b></td>
				         <td class='left'>$r[isi_testimoni]</td>
                 <td>";
            if($r['status']=='Y'){
              echo "<b style='color:#089400'>ditampilkan</b>";
            }else{
              echo "<b style='color:red'>tidak ditampilkan</b>";
            }
            echo"</td>
                 <td class='center' width='50px'><a href=?module=$module&act=editTestimoni&id=$r[id_testimoni]><img src='images/add-icon.gif' title='edit' /></a></td>

    	         <td width='50px'><a href=$aksi?module=$module&act=hapus&id=$r[id_testimoni]&file=$r[gambar]><img src='images/hr.gif' title='hapus' /></a>
                 </td></tr>";
          $no++;
        }
        echo "</table>";
    }
    break;
  
  // Form Tambah Perusahaan Pengiriman
  case "addTestimoni":
    echo "<h2 class='hLine'>Tambah Testimoni</h2>
          <form method=POST action='$aksi?module=$module&act=input' enctype='multipart/form-data' onSubmit=\"return validasi(this)\">
          <table class='list'>
          <tr>
			<td class='left' width=150px>Dari</td>
			<td class='left'> : <input type=text name='dari'></td>
		  </tr>
		  <tr>
			<td class='left' width=150px>Isi</td>
			<td class='left'> : <textarea name='isi_testimoni'  id='jogmce' style='height:400px;'></textarea>
		  </tr>
         <td class='left' colspan=2><input class='butt' type=submit name=submit value=Simpan>
                            <input type=button class='butt' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
  
	// Form Edit Perusahaan Pengiriman  
	case "editTestimoni":
    $edit=mysql_query("SELECT * FROM mod_testimoni WHERE id_testimoni='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Testimoni</h2>
          <form method=POST action='$aksi?module=$module&act=update' enctype='multipart/form-data' onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[id_testimoni]'>
          <table class='list'>
          <tr>
			<td class='left'>Dari</td>
			<td class='left'> <input type=text name='dari' value='$r[dari]'></td></tr>
		  <tr>
			<td class='left' width=150px>Isi</td>
			<td class='left'> : <textarea name='isi_testimoni' id='jogmce' style='height:400px;'>$r[isi_testimoni]</textarea>
		  </tr>
		  <tr>
			<td class='left'>Status</td>
			<td class='left'>
      <select name='status'>";
      if($r[status]=='Y'){
          echo "<option value='Y'  selected>ditampilkan</option><option value='N'>tidak ditampilkan</option>";
        }elseif($r[status]=='N'){
          echo "<option value='Y'>ditampilkan</option><option value='N' selected>tidak ditampilkan</option>";
        }

      echo"
      </select>
      </td></tr>
          <tr>
			<td class='left' colspan=2>
				<input class='butt' type=submit value=Update>
				<input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}

}
?>
