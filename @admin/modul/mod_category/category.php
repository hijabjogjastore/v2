<?php
$aksi="modul/mod_category/aksi_category.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<h2 class='hLine'>Category</h2>
          <input type=button class=butt value='Tambahkan Category' 
          onclick=\"window.location.href='?module=category&act=tambahcategory';\">
          <table class='list'>
          <thead>
			<tr><td class='center'>No.</td><td class='center'>Category</td><td class='center' colspan='2'>Aksi</td></tr></thead>"; 
    $tampil=mysql_query("SELECT * FROM category ORDER BY category_id ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
    			 <td>$no.</td>
				 <td class='left'>$r[category_name]</td>
				 <td width='45'><a href=?module=category&act=editcategory&id=$r[category_id]><img src='images/add-icon.gif' title='edit' /></a></td>
				 <td width='45'><a href=$aksi?module=category&act=hapus&id=$r[category_id]><img src='images/hr.gif' title='hapus' /></a></td>
			 </tr>";
      $no++;
    }
    echo "</table>";
	echo "";
    break;
  
  // Form Tambah Kategori
  case "tambahcategory":
    echo "<h2 class='hLine'>Tambah Category</h2>
          <form method=POST action='$aksi?module=category&act=input'>
          <table class='list'>
          <tr>
			<td class='left'>Nama</td>
			<td class='left'> : <input type=text name='category_name'></td>
		  </tr>
		  
          <tr>
			<td class='left' colspan=2>
				<input type=submit name=submit class=butt value=Simpan>
                <input type=button class=butt value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit kategori  
  case "editcategory":
    $edit=mysql_query("SELECT * FROM category WHERE category_id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Category</h2>
          <form method=POST action=$aksi?module=category&act=update>
          <input type=hidden name=id value='$r[category_id]'>
          <table class='list'>
          <tr>
			<td class='left'>Nama</td>
			<td class='left'> <input type=text name='category_name' value='$r[category_name]'></td></tr>
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
