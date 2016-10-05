
<div class="col-lg-3 col-md-3 col-xs-12 sidebar">
		<div class="row">
			<div class="sidebar-collapse col-lg-12 col-md-12 col-xs-12" style="margin-top: 10px;">
				<div class="list-group">
						<div class="list-group-item">
							<center class="shipping">
								
								<?php 
									$shipping=mysql_query("SELECT * FROM mod_sosial");
									while($s=mysql_fetch_array($shipping)){
								?>
								<a target="_blank" href="<?php echo"$s[link]"; ?>"><img src="joimg/<?php echo"$s[gambar]" ?>" style='width:35px'></a>
								<?php } ?>
							</center>
						</div>
				</div>
			</div>
		
		</div>
</div>
<!--
<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fblezerwanita%3Fref%3Dhl&amp;width&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:220px; height:290px;height:290px;" allowTransparency="true"></iframe>

<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FDyKaboutique%3Fref%3Dhl&amp;width=220&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:220px; height:258px;" allowTransparency="true"></iframe>
-->