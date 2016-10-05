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
//produk terlaris
echo '<div class="sb_box _textCenter">';
echo '<h2 class="hTitle _uppercase _big">Best Seller</h2>';
$new_prod = mysql_query("SELECT * FROM produk WHERE terlaris='Y' ORDER BY id_produk DESC LIMIT 6");
				while($n=mysql_fetch_array($new_prod))
				{
					$harga 		= format_rupiah($n['harga']);
					$linkBeli 	= 'addcart&idp='.$n['id_produk'];
					//kategori
					$category=mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$n[id_kategori]'");
					$c=mysql_fetch_array($category);
	
					echo "<div class='prodBox _textLeft'>
							<div class='prodImg _textLeft'>
							<a href='produk-$n[id_produk]-$n[produk_seo].html' title='$n[nama_produk]'>
								<img class='catImg' src='joimg/produk/$n[gambar]' border='0' width='110px' />
							</a>
							</div>
							<div class='prodMeta _textLeft'>
								<strong>
								<p class='_capitalize pTitle'>
									<a href='produk-$n[id_produk]-$n[produk_seo].html' title='$n[nama_produk]'>
									$n[nama_produk]
									</a>
								</p>
								</strong>
							</div>
							
							<div class='prodPrice'> price: <b>$harga Rp.</b></div>
						</div>";
				}
				echo "<div class='clear'></div>";
echo '</div>';


//mod banner promo/slide produk
echo '<div class="sb_box _textCenter">';
echo '<h2 class="hTitle _uppercase _big">Promo</h2>';


	$promo = mysql_query("SELECT * FROM produk WHERE special='Y' ORDER BY id_produk ASC LIMIT 9");
				while($n=mysql_fetch_array($promo))
				{
					$harga 		= format_rupiah($n['harga']);
					$linkBeli 	= 'addcart&idp='.$n['id_produk'];
					//kategori
					$category=mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$n[id_kategori]'");
					$c=mysql_fetch_array($category);
	
					echo "<div class='prodBox _textLeft'>
							<div class='prodImg _textLeft'>
							<a href='produk-$n[id_produk]-$n[produk_seo].html' title='$n[nama_produk]'>
								<img class='catImg' src='joimg/produk/$n[gambar]' border='0' width='110px' />
							</a>
							</div>
							<div class='prodMeta _textLeft'>
								<strong>
								<p class='_capitalize pTitle'>
									<a href='produk-$n[id_produk]-$n[produk_seo].html' title='$n[nama_produk]'>
									$n[nama_produk]
									</a>
								</p>
								</strong>
							</div>
							
							<div class='prodPrice'> price: <b>$harga Rp.</b></div>
						</div>";
				}
				echo "<div class='clear'></div>";

echo '</div>';
?>