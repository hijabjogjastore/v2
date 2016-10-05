<?php
	echo '<div class="mBox" style="min-height:250px; margin-bottom: 10px;">';
				//slideshow
				echo "<div class='slider-wrapper theme-default' style='margin-bottom:15px;'>
				<div id='slider' class='nivoSlider'>";
				$slides=mysql_query("SELECT * FROM mod_slider ORDER BY id_slider ASC");
				while($s=mysql_fetch_array($slides))
				{
				  echo "<img src='joimg/slides/$s[gambar]' />";
				}
				echo "</div></div>";
	echo '</div>';
?>
<div class="prodW">
	<?php
	//dapatkan produk yang sesuai id-nya
	$prod = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$p=mysql_fetch_array($prod);
	
	//Query SubImages dari database
	$images = mysql_query("SELECT * FROM subimages WHERE id_produk='$_GET[id]' limit 18");
	$gambar=mysql_num_rows($images);
    
	echo '<h2 class="hTitle _uppercase _big">Product Detail</h2>';
	
	$harga 		= format_rupiah($p['harga']);
	//link beli
	$linkBeli 	= 'addcart&idp='.$p['id_produk'];
						
	//dapatkan kategori produk tersebut
	$kat=mysql_query("SELECT * FROM kategori WHERE id_kategori='$p[id_kategori]'");
	$k=mysql_fetch_array($kat);
	
	$divharga = '<span class="prodPriceDetail">'.$harga.'</span>';
	
	$pics = mysql_query("SELECT * FROM produk_to_opsi,produk_atribut 
	WHERE produk_to_opsi.id_produk='$p[id_produk]' AND produk_to_opsi.id_atribut=produk_atribut.id_atribut");
	$cek_pics = mysql_num_rows($pics);
	
	/*Main Images*/
	echo "<div class='divIprod _capitalize'>"; ?>
			<a class="fancybox" href="<?php echo "joimg/produk/$p[gambar]"; ?>" data-fancybox-group="gallery">
			<img class="img-polaroid" src="<?php echo "joimg/produk/$p[gambar]"; ?>"/>
			</a>
			<p>&nbsp;</p>
	<?php
	echo "</div>
		<div class='divTprod'>
			<p class='pLine _capitalize pTitleDetail'><b>$p[nama_produk] </b></p>
			<p class='pLine _capitalize'><b>Price: </b> $divharga Rp</p>";
		
			echo "<p class='pbutt _uppercase'>
					<a href='{$linkBeli}' title='$n[nama_produk]'><img src='jolibs/images/beli.png' alt='cara membuat link pada gambar style='height: 20px; width: 50px;'></a>
				</p></br>
				<p>
					<span class='st_facebook_large' displayText='Facebook'></span>
					<span class='st_twitter_large' displayText='Tweet'></span>
					<span class='st_email_large' displayText='Email'></span>
					<span class='st_googleplus_large' displayText='Google +'></span>
					<span class='st_blogger_large' displayText='Blogger'></span>
				</p>
		</div>
	<input type='hidden' id='idp' name='idp' value='$p[id_produk]' />
	<input type='hidden' id='ido' name='ido' value='' />";
	echo "<div class='clear'></div>";
	
	/*Sub Images*/
	while($subimage=mysql_fetch_array($images)){
	echo "<div class='divKetProdDetail _justify'>"; ?>
		<a class="fancybox" href="<?php echo "joimg/subimages/$subimage[gambar]"; ?>" data-fancybox-group="gallery">
		<img class="img-polaroid" src="<?php echo "joimg/subimages/$subimage[gambar]"; ?>" width='105px' height='135' alt="" />
		</a>
	<?php
	echo "</div>";
	}
	
	//Deskripsi Produk Detail
	echo "<div class='clear divKetProd _justify'>
		<h1 class='pgTitle _capitalize'>Deskripsi Barang</h1>";
			echo $p['deskripsi'];				
	echo "</div>";
	echo "<div class='clear'></div>";
	
	
	//produk terkait
		/*
		$sql=mysql_query("SELECT * FROM produk WHERE id_kategori='$p[id_kategori]' And id_produk!='$p[id_produk]' LIMIT 3");
		$cek = mysql_num_rows($sql);
		if($cek)
		{
			echo "<div style='margin-top:15px;'>";
			echo "<h2 class='hTitle _uppercase _big'>Produk Lainnya</h2>";
				while($s=mysql_fetch_array($sql))
				{
					echo "<div class='prodBox _textLeft'>
								<div class='prodImg _textLeft'>
								<div class='prodMeta _textLeft'>
									<a href='produk-$s[id_produk]-$s[produk_seo].html' title='$s[nama_produk]'>
										<img class='catImg' src='joimg/produk/$s[gambar]' border='0' width='110px' />
									</a>
									<p class='_capitalize pTitle'>
										<a href='produk-$s[id_produk]-$s[produk_seo].html' title='$s[nama_produk]'>$s[nama_produk]</a>
									</p>
								</div>
								</div>
								";
					echo "</div>";
				}
			echo "<div class='clear'></div>";
			echo "</div>";
		}
			else { }
		*/
	?>
</div>
<script>jQuery('#zoom01, .cloud-zoom-gallery').CloudZoom();</script>
<script type="text/javascript">
$('.imgBox').fancybox({
	prevEffect : 'elastic',
	nextEffect : 'elastic',
	closeBtn  : false,
	arrows    : true,
	nextClick : true,
	padding: 4,

		helpers : {
				title : { type: 'outside'},
				thumbs : {
						position: 'bottom',
						width  : 50,
						height : 50
					},
				overlay : {
				css : {
                'background' : 'rgba(0, 0, 0, .85)'
						}
					}
				}
			});
</script>