<!--produk-->
<div class="prodW">
		<?php
		 $news=mysql_query("SELECT * FROM mod_news WHERE id_news='$_GET[id]' ");
		       
				while($n=mysql_fetch_array($news))
				{	
					echo "<div class='news'>
						<div class='title'>
							<label>$n[judul]</label>
							</div>
							<div>
							<img src='joimg/news/s_$n[gambar]' style='float:left; padding:5px; margin-right:7px; margin-bottom:7px;' />
							$n[isi_berita]
							</div>
						</div>";
				}
				echo "<div class='clear'></div>";

		?>
</div>
<!--/produk-->
