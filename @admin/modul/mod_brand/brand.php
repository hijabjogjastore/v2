<?php
$aksi="modul/mod_brand/aksi_brand.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<h2 class='hLine'>Brand</h2>
          <input type=button class=butt value='Tambahkan Brand' 
          onclick=\"window.location.href='?module=brand&act=tambahbrand';\">
          <table class='list'>
          <thead>
			<tr><td class='center'>No.</td><td class='center'>Kategori</td><td class='center' colspan='2'>Aksi</td></tr></thead>"; 
    $tampil=mysql_query("SELECT * FROM brand ORDER BY brand_id ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
    			 <td>$no.</td>
				 <td class='left'>$r[brand_name]</td>
				 <td width='45'><a href=?module=brand&act=editbrand&id=$r[brand_id]><img src='images/add-icon.gif' title='edit' /></a></td>
				 <td width='45'><a href=$aksi?module=brand&act=hapus&id=$r[brand_id]><img src='images/hr.gif' title='hapus' /></a></td>
			 </tr>";
      $no++;
    }
    echo "</table>";
	echo "";
    break;
  
  // Form Tambah Kategori
  case "tambahbrand":
    echo "<h2 class='hLine'>Tambah Brand</h2>
          <form method=POST action='$aksi?module=brand&act=input'>
          <table class='list'>
          <tr>
			<td class='left'>Nama</td>
			<td class='left'> : <input type=text name='brand_name'></td>
		  </tr>
		  
          <tr>
			<td class='left' colspan=2>
				<input type=submit name=submit class=butt value=Simpan>
                <input type=button class=butt value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit kategori  
  case "editbrand":
    $edit=mysql_query("SELECT * FROM brand WHERE brand_id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Kategori</h2>
          <form method=POST action=$aksi?module=brand&act=update>
          <input type=hidden name=id value='$r[brand_id]'>
          <table class='list'>
          <tr>
			<td class='left'>Nama</td>
			<td class='left'> <input type=text name='nama' value='$r[brand_name]'></td></tr>
		  </tr>
          <tr>
			<td class='left' colspan=2>
				<input type=submit class=butt value=Update>
                <input type=button class=butt value=Batal onclick=self.history.back()>
			</td>
		  </tr>
          </table></form>";
    break;  
}
?>
