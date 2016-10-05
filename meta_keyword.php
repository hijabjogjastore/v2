<?php
if($_GET['mod']=='home'){
	$seo = mysql_query("SELECT * FROM mod_page WHERE id_page='1'");
	$s=mysql_fetch_array($seo);
	echo trim($s['meta_keyword']);
} else {

	if($_GET['mod']=='page'){
		$page=mysql_query("select * from mod_page where id_page='$_GET[id]'");
		$p=mysql_fetch_array($page);
		$meta_keyword = trim($p['meta_keyword']);
		if(!empty($meta_keyword)){
			echo $meta_keyword;
		} else { }
	}
	
	//kategori detail
	elseif($_GET['mod']=='detailKategori'){
		$id=$_GET['id'];
		$kql = mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$id'");
		$k=mysql_fetch_array($kql);
		echo trim($k['meta_keyword']);
	}
	
	//produk detail
	elseif($_GET['mod']=='product-detail'){
		$id= $_GET['id'];
		$sql = mysql_query("SELECT * FROM product WHERE product_id='$id'");
		$s=mysql_fetch_array($sql);
		//get kategori
		$kat=mysql_query("SELECT * FROM category WHERE category_id='$s[category_id]'");
		$k=mysql_fetch_array($kat);
		echo $s['product_name'].','.$k['category_seo'];
	}
	
}