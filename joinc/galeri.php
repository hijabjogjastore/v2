<!--produk-->
<div class="prodW">
		<?php
		 $news=mysql_query("SELECT * FROM galeri WHERE id_album='$_GET[id]' ORDER BY id_album DESC ");
		       
				while($n=mysql_fetch_array($news))
				{
					echo "<div class='news'>
					        <div style='width:130px' align='center'>
							<a href='joimg/galeri/$n[gambar]' data-fancybox-group='thumb' class='imgBox'>
							<img src='joimg/galeri/s_$n[gambar]' style='float:left; padding:5px; margin-right:7px; margin-bottom:7px;' />
							</a>
							<label>$n[judul]</label>
							</div>
						</div>";
				}
				echo "<div class='clear'></div>";

		?>
</div>
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
<!--/produk-->
