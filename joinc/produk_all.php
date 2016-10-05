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

<!--produk-->
<div class="prodW">
		<?php
		echo '<h2 class="hTitle _uppercase _big">All Products</h2>';
		$p      = new Paging;
		$batas  = 15;
		$posisi = $p->cariPosisi($batas);
				
		$new_prod = mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");
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
							
							<div class='prodPrice'> Rp. $harga,-</div>
							<p class='pbutt _uppercase'>
							<a href='{$linkBeli}' title='$n[nama_produk]'><img src='jolibs/images/beli.png' alt='cara membuat link pada gambar style='height: 20px; width: 50px;'></a>
							</p>
							
						</div>";
				}
				echo "<div class='clear'></div>";
$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk ORDER BY id_produk ASC"));
$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
$linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
  
  echo "<div class='rBox'> <br /><div class='paging'>$linkHalaman <br /><br /></div></div>";
		?>
</div>
<!--<p class='pbutt _uppercase'><a href='cara-pemesanan' title='$n[nama_produk]'>Beli</a></p>-->
