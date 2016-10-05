<!--produk-->
<div class="prodW">
		<?php
		 $news=mysql_query("SELECT * FROM album ORDER BY id_album DESC ");
		       
				while($n=mysql_fetch_array($news))
				{
					echo "<div class='news'>
							<div style='width:130px' align='center'>
							<a href='album-$n[id_album]' style='text-decoration:none; cursor:pointer;'>
							<img src='joimg/album/s_$n[gambar]' style='float:left; padding:5px; margin-right:7px; margin-bottom:7px;' />
							</a>
							<a href='album-$n[id_album]' style='text-decoration:none;'><label style='cursor:pointer;'>$n[judul]</label></a>
							</div>
						</div>";
				}
				echo "<div class='clear'></div>";

		?>
</div>
<!--/produk-->
