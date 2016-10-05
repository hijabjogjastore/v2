<?php
$home = '<a href="index.php">Home</a>';
$contact = '<a href="kontak">Kontak</a>';


if($_GET['mod']=='home'){
	$breadcumb = '';
}

//page-halaman
elseif($_GET['mod']=='page'){
	
	$sql=mysql_query("SELECT * FROM mod_page WHERE id_page='$_GET[id]'");
	$s=mysql_fetch_array($sql);	

	if($s['id_page']==1 || $s['id_page']==6){
		$breadcumb = '<div class="bCumb _capitalize">'.$home.' &raquo; 404</div>';
	}
		else { 
			$breadcumb = '<div class="bCumb _capitalize">'.$home.' &raquo; <font style="padding-bottom:2px; text-decoration: underline;">'.$s['judul'].'</font></div>';
		}

}

//produk kategori
elseif($_GET['mod']=='detailKategori'){
	$kat=mysql_fetch_array(mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$_GET[id]'"));
	$breadcumb = '<div class="bCumb _capitalize">'.$home.' &raquo; produk &raquo; '.$kat['nama_kategori'].'</div>';
}

//detail produk
elseif($_GET['mod']=='product-detail'){
	
	$prod=mysql_query("SELECT * FROM product WHERE product_id='$_GET[id]'");
	$p=mysql_fetch_array($prod);
	
	$proKat=mysql_query("SELECT * FROM kategori_produk WHERE id_kategori=$p[id_kategori]");
	$pK = mysql_fetch_array($proKat);
	$katLink = "<a href='$pK[id_kategori]-kategori-$pK[kategori_seo]'>$pK[nama_kategori]</a>";
	
	$breadcumb = '<div class="bCumb _capitalize"> Kategori &raquo; '.$katLink.' &raquo; '.$p['nama_produk'] .'</div>';
}

