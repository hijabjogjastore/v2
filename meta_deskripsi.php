<?php
if($_GET['mod']=='home'){
	$seo = mysql_query("SELECT * FROM mod_page WHERE id_page='1'");
	$s=mysql_fetch_array($seo);
	$meta_deskripsi = trim(strip_tags($s['meta_deskripsi']));
	$def_meta_d = $meta_deskripsi;
	echo $def_meta_d;
} else {

	//produk detail
	if($_GET['mod']=='detailProduk'){
		$id= $_GET['id'];
		$sql = mysql_query("SELECT * FROM produk WHERE id_produk='$id'");
		$s=mysql_fetch_array($sql);
		//get kategori
		$kat=mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$s[id_kategori]'");
		$k=mysql_fetch_array($kat);
		
		$meta_deskripsi = strip_tags($s['deskripsi']);
		
		echo $meta_deskripsi;
	}
	
	//kategori detail
	elseif($_GET['mod']=='detailKategori'){
		$id=$_GET['id'];
		$kql = mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$id'");
		$k=mysql_fetch_array($kql);
		
		if(!empty($k['meta_deskripsi'])){
			echo $k['meta_deskripsi'];
		} else { echo $k['nama_kategori']; }
	}
	
	//mod page
	elseif($_GET['mod']=='page'){
		$page=mysql_query("select * from mod_page where id_page='$_GET[id]'");
		$p=mysql_fetch_array($page);
		$meta_deskripsi= strip_tags(trim($p['meta_deskripsi']));
		if(!empty($meta_deskripsi)){
			echo $meta_deskripsi;
		} else { echo $p['judul']; }
	}
	
}