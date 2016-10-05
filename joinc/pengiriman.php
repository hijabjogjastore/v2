<div class="col-lg-3 col-md-3 col-xs-12 sidebar">
		<div class="row">
			<div class="sidebar-collapse col-lg-12 col-md-12 col-xs-12" style="margin-top: 10px;">
				<div class="list-group">
						<div class="list-group-item">
							<center class="shipping">
								
								<?php 
									$shipping=mysql_query("SELECT * FROM mod_kurir ORDER BY id_kurir ASC");
									while($s=mysql_fetch_array($shipping)){
								?>
								<a target="_blank" href="<?php echo"$s[link]"; ?>"><img src="joimg/shipping/<?php echo"$s[gambar]" ?>" style='width:55px' height='40px'></a>
								<?php } ?>
							</center>
						</div>
				</div>
			</div>
		
		</div>
</div>