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
<?php
	$kat=mysql_query("SELECT * FROM subkategori WHERE id_subkategori='$_GET[id]'");
	$k=mysql_fetch_array($kat);
	
	echo "<div class='prodW'>";
	echo '<h2 class="hTitle _uppercase _big">'.$k['nama'].'</h2>';
	
	$prod=mysql_query("SELECT * FROM produk WHERE id_subkategori=$k[id_subkategori]");
	$cek = mysql_num_rows($prod);
	if(!$cek) { echo "Belum ada produk"; } else 
	{
		while($p=mysql_fetch_array($prod))
		{
			$harga 		= format_rupiah($p['harga']);
			//link beli
			$linkBeli 	= 'cart.php?mod=basket&act=add&id='.$p['id_produk'];
			//kategori
			$category=mysql_query("SELECT * FROM kategori WHERE id_kategori='$p[id_kategori]'");
			$c=mysql_fetch_array($category);
			
			echo "<div class='prodBox _textLeft'>
							<div class='prodImg _textLeft'>
							<a href='produk-$p[id_produk]-$p[produk_seo].html' title='$n[nama_produk]'>
								<img class='catImg' src='joimg/produk/$p[gambar]' border='0' width='110px' />
							</a>
							</div>
							<div class='prodMeta _textLeft'>
								
								<p class='_capitalize pTitle'>
									<a href='produk-$p[id_produk]-$p[produk_seo].html' title='$p[nama_produk]'>
									$p[nama_produk]
									</a>
								</p>
							</div>
							<div class='prodPrice'> Rp. $harga,-</div>
							<p class='pbutt _uppercase'>
							<a href='{$linkBeli}' title='$n[nama_produk]'><img src='jolibs/images/beli.png' alt='cara membuat link pada gambar style='height: 20px; width: 50px;'></a>
							</p>
							</div>";
		}
	}
	echo "<div class='clear'></div>";
	echo "</div>";

?>
<!-- <p class='pbutt _uppercase'><a href='{$linkBeli}' title='$p[nama_produk]'>Beli</a></p> -->