<?php
$aksi="modul/mod_subkategori/aksi_subkategori.php";
switch($_GET[act]){
  // Tampil Sub Kategori
  default:
    echo "<h2 class='hLine'>Sub Kategori</h2>
          <input type=button class=butt value='Tambahkan Sub Kategori' 
          onclick=\"window.location.href='?module=subkategori&act=tambahsubkategori';\">
          <table class='list'>
          <thead>
			<tr><td class='center'>No.</td><td class='center'>Sub Kategori</td>
			<td class='center' colspan='2'>Aksi</td></tr></thead>"; 
    $tampil=mysql_query("SELECT * FROM subkategori ORDER BY id_subkategori ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
    			 <td>$no.</td>
				 <td class='left'>$r[nama]</td>
				 <td width='45'>
					<a href=?module=subkategori&act=editsubkategori&id=$r[id_subkategori]><img src='images/add-icon.gif' title='edit' />
					</a>
				 </td>
				 <td width='45'>
					<a href=$aksi?module=subkategori&act=hapus&id=$r[id_subkategori]><img src='images/hr.gif' title='hapus' />
					</a>
				  </td>
			 
			 </tr>";
      $no++;
    }
    echo "</table>";
	echo "";
    break;
  
  // Form Tambah Sub Kategori
  case "tambahsubkategori":
    echo "<h2 class='hLine'>Tambah Sub Kategori</h2>
          <form method=POST action='$aksi?module=subkategori&act=input'>
          <table class='list'>
          <tr>
			<td class='left'>Kategori</td>
			<td class='left'> : ";
				
?>			
			
			<select name="kategori">
							<?php
								$kateg = mysql_query("SELECT * FROM kategori ORDER BY nama ASC");
								while($tkateg=mysql_fetch_array($kateg)){
								?>
								<option value="<?php echo $tkateg['id_kategori'];?>">
									<?php echo $tkateg['nama'];?>
								</option>
								<?php
								}
								?>
			</select>
				
<?php				
echo"
			</td>
		  </tr>
		  <tr>
			<td class='left'>Nama</td>
			<td class='left'> :<input type=text name='nama'></td>
		  </tr>
          <tr>
			<td class='left' colspan=2>
				<input type=submit name=submit class=butt value=Simpan>
                <input type=button class=butt value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Subkategori  
  case "editsubkategori":
    $edit=mysql_query("SELECT * FROM subkategori WHERE id_subkategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Sub Kategori</h2>
          <form method=POST action=$aksi?module=subkategori&act=update>
          <input type=hidden name=id value='$r[id_subkategori]'>
          <table class='list'>
          <tr>
			<td class='left'>Kategori</td>
			<td class='left'>";
?>			
			<select name="kategori"">
								<?php
								$kateg = mysql_query("SELECT * FROM kategori ORDER BY nama ASC");
								while($tkateg=mysql_fetch_array($kateg)){
								if($tkateg['id_kategori']==$r['id_kategori']){
								?>
								<option value="<?php echo $tkateg['id_kategori'];?>" selected><?php echo $tkateg['nama'];?></option>
								<?php
								}else{
								?>
								<option value="<?php echo $tkateg['id_kategori'];?>"><?php echo $tkateg['nama'];?></option>
								<?php
								}
								}
								?>
			</select>
		  
		  
<?php		  
	echo "	
			</tr>
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
