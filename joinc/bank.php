<div class="col-lg-3 col-md-3 col-xs-12 sidebar">
		<div class="row">
			<div class="sidebar-collapse col-lg-12 col-md-12 col-xs-12" style="margin-top: 10px;">
				<div class="list-group">
						<div class="list-group-item">
							<center class="shipping">
								
								<?php 
									$shipping=mysql_query("SELECT * FROM mod_bank ORDER BY id_bank ASC");
									while($s=mysql_fetch_array($shipping)){
								?>
								<a><img src="joimg/bank/<?php echo"$s[gambar]" ?>" style='width:60px' height='40px'></a>
								<?php } ?>
							</center>
						</div>
				</div>
			</div>
		
		</div>
</div>