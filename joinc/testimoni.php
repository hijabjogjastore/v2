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
			echo '<h2 class="hTitle _uppercase _big">Testimony</h2>';
		 $news=mysql_query("SELECT * FROM mod_testimoni ORDER BY id_testimoni DESC ");
		       
				while($n=mysql_fetch_array($news))
				{
					echo "<div class='news' style='border-bottom: 1px solid #000; padding-bottom: 10px;'>
							<div>
							<img src='joimg/testimoni/s_$n[gambar]' style='float:left; padding:5px; margin-right:7px; margin-bottom:7px;'>
							<b>$n[dari]</b>$n[isi_testimoni] 
							</div>
						</div>";
				}
				echo "<div class='clear'></div>";

		?>
</div>
<!--/produk-->
