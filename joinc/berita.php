<!--produk-->
<div class="prodW">
		<?php
		 $news=mysql_query("SELECT * FROM mod_news ORDER BY id_news DESC ");
		       
				while($n=mysql_fetch_array($news))
				{
				$position=300; // Define how many character you want to display.
				$message="$n[isi_berita]"; 
				$post = substr($message, 0, $position); 	
					echo "<div class='news'>
						<div class='title'>
							<label>$n[judul]</label>
							</div>
							<div>
							<img src='joimg/news/s_$n[gambar]' style='float:left; padding:5px; margin-right:7px; margin-bottom:7px;' />
							$post ... <a href='news-$n[id_news].html'>Selengkapnya</a>
							</div>
						</div>";
				}
				echo "<div class='clear'></div>";

		?>
</div>
<!--/produk-->
