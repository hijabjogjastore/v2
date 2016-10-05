<?php
/**
 * website title SEO
 * **/


$default = "HIJAB JOGJA STORE |";
//home
if($_GET['mod']=='home')
{
	echo $default." Hijab Jogja Store Ingin Kita Tampil Modis Berjilbab Dalam Segala Suasana";
}
else {

//page-halaman statis
	if($_GET['mod']=='page')
	{
		$page=mysql_query("select judul from mod_page where id_page='$_GET[id]'");
		$p=mysql_fetch_array($page);
		echo $default."| $p[judul]";
	}
	
//produk detail
	elseif($_GET['mod']=='detailProduk'){
		$id= $_GET['id'];
		$sql = mysql_query("SELECT * FROM produk WHERE id_produk='$id'");
		$s=mysql_fetch_array($sql);
		//get kategori
		$kat=mysql_query("SELECT * FROM kategori WHERE id_kategori='$s[id_kategori]'");
		$k=mysql_fetch_array($kat);
		echo $default."| $k[nama] - $s[nama_produk]";
	}

//kategori detail
	elseif($_GET['mod']=='detailKategori'){
		$id=$_GET['id'];
		$kql = mysql_query("SELECT * FROM kategori WHERE id_kategori='$id'");
		$k=mysql_fetch_array($kql);
		echo $default."| $k[nama]";
	}
	
}
?>
