<?php
$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<h2 class='hLine'>Kategori</h2>
          <input type=button class=butt value='Tambahkan Kategori' 
          onclick=\"window.location.href='?module=kategori&act=tambahkategori';\">
          <table class='list'>
          <thead>
			<tr><td class='center'>No.</td><td class='center'>Kategori</td><td class='center' colspan='2'>Aksi</td></tr></thead>"; 
    $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
    			 <td>$no.</td>
				 <td class='left'>$r[nama]</td>
				 <td width='45'><a href=?module=kategori&act=editkategori&id=$r[id_kategori]><img src='images/add-icon.gif' title='edit' /></a></td>
				 <td width='45'><a href=$aksi?module=kategori&act=hapus&id=$r[id_kategori]><img src='images/hr.gif' title='hapus' /></a></td>
			 </tr>";
      $no++;
    }
    echo "</table>";
	echo "";
    break;
  
  // Form Tambah Kategori
  case "tambahkategori":
    echo "<h2 class='hLine'>Tambah Kategori</h2>
          <form method=POST action='$aksi?module=kategori&act=input'>
          <table class='list'>
          <tr>
			<td class='left'>Nama</td>
			<td class='left'> : <input type=text name='nama'></td>
		  </tr>
		  
          <tr>
			<td class='left' colspan=2>
				<input type=submit name=submit class=butt value=Simpan>
                <input type=button class=butt value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit kategori  
  case "editkategori":
    $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Kategori</h2>
          <form method=POST action=$aksi?module=kategori&act=update>
          <input type=hidden name=id value='$r[id_kategori]'>
          <table class='list'>
          <tr>
			<td class='left'>Nama</td>
			<td class='left'> <input type=text name='nama' value='$r[nama]'></td></tr>
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
