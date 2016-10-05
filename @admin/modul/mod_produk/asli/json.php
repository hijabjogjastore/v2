<?php
include "koneksi.php";
$json = array(); 
$id=$_POST['id_kategori'];
$result = mysql_query("SELECT * FROM subkategori WHERE id_kategori='$id'", $link_id);	
if($id==''){
$json[] = array( 
	'id_subkategori' => '', 
	'nama' => '-- Sub Kategori --'
); }

while($baris=mysql_fetch_array($result))
{
    $json[] = array( 
        'id_subkategori' => $baris['id_subkategori'], 
        'nama' => $baris['nama']
    ); 
}
 
echo json_encode($json);
?>