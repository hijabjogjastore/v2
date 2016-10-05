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
				$kategori=mysql_query("SELECT * FROM kategori WHERE id_kategori = '$_GET[id]'");
				$k=mysql_fetch_array($kategori);
				
				$namakategori=$k['nama'];
				
				$p = new Paging;			
				$batas = 12;
				$posisi = $p->cariPosisi($batas);
				
				if(empty($_GET['srt'])){
				$produk=mysql_query("SELECT * FROM produk WHERE id_kategori = '$_GET[id]' ORDER BY harga DESC LIMIT $posisi,$batas");
				$bread = "";
				}elseif($_GET['srt']=='atz'){
				$produk=mysql_query("SELECT * FROM produk WHERE id_kategori = '$_GET[id]' ORDER BY nama_produk ASC LIMIT $posisi,$batas");
				$bread = "Sort Product By Name A > Z";
				}elseif($_GET['srt']=='zta'){
				$produk=mysql_query("SELECT * FROM produk WHERE id_kategori = '$_GET[id]' ORDER BY nama_produk DESC LIMIT $posisi,$batas");
				$bread = "Sort Product By Name Z > A";
				}elseif($_GET['srt']=='lth'){
				$produk=mysql_query("SELECT * FROM produk WHERE id_kategori = '$_GET[id]' ORDER BY harga ASC LIMIT $posisi,$batas");
				$bread = "Sort By Price Low > Hight";
				}elseif($_GET['srt']=='htl'){
				$produk=mysql_query("SELECT * FROM produk WHERE id_kategori = '$_GET[id]' ORDER BY harga DESC LIMIT $posisi,$batas");
				$bread = "Sort By Price Hight > Low";
				}else{
				$bread = "";
				}
				
				$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id_kategori = '$_GET[id]'"));
				$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
				$linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
				
				
			?>
		 
				<div class="breadcrumb"><a href="">Home</a>  /  <a href=""><?php echo $k['nama']; ?></a> / <?php echo $bread; ?></div>
     	    
				<?php include('joinc/sidebar.php'); ?>
		
				<div class="cont span_2_of_3">
					<div class="mens-toolbar">
						<div class="sort" style="float:right;">
							<div class="sort-by">
								<label>Sort By</label>
								<select name="sort" id="sort" onchange="location = this.value">
									<option value="#" selected>Default</option>
									<option value="<?php echo "sort-atz-$_GET[id]-$_GET[seo]"; ?>">Name A > Z</option>
									<option value="<?php echo "sort-zta-$_GET[id]-$_GET[seo]"; ?>">Name Z > A</option>
									<option value="<?php echo "sort-lth-$_GET[id]-$_GET[seo]"; ?>">Price Low > High</option>
									<option value="<?php echo "sort-htl-$_GET[id]-$_GET[seo]"; ?>">Price High > Low</option>
								</select>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="box1">
				
						<?php 
						
						$z = mysql_num_rows($produk);
						if($z == 0){ 
							echo"Not Found !";
						}
						else{
						
						while($p=mysql_fetch_array($produk)){
							$nama = substr($p["nama_produk"],0,30);
							
						$harga       = number_format(($p['harga']),0,",",".");
						$disc        = ($p['discount']/100)*$p['harga'];
						$hargadisc   = number_format(($p['harga']-$disc),0,",",".");
						
						?>
						
						<div class="col_1_of_3 span_1_of_3"><a href="product-<?php echo"$p[id_produk]"; ?>-<?php echo"$p[produk_seo]"; ?>">
				     <div class="view view-fifth">
						
				  	  <div class="top_box">
				         <div class="grid_img">
						   <div class="css3"><img src="joimg/produk/s_<?php echo"$p[gambar]"; ?>" alt=""/></div>
	                    </div>
					  	<h3 class="m_2"><?php echo"$p[nama_produk]"; ?></h3>
					  	<p class="m_2"><?php echo $namakategori; ?></p>
                       <div class="price">Rp <?php echo"$hargadisc"; ?></div>
					   </div>
					    </div>
					  
						 <ul>
							<li>
								<ul>
									<li style="background: #990000;padding: 10px 20px 5px 13px;float: left; margin-top: -17px;">
									<?php if($p['stok'] > '0') {?>
										<a class="d" href="javascript: addtochart(<?php echo"$p[id_produk]"; ?>)"><img width="30px" src="images/cart.png"></a>
									<?php } else { ?>
										<a class="d" href="javascript: window.alert('Out of Stock!');"><img width="30px" src="images/cart.png"></a>
									<?php } ?>
									</li>
								</ul>
							</li>
					    </ul>
						
						<ul>
							<li>
								<ul>
									<li style="background: #000000;padding: 8px 10px 3px 12px;float: right;margin-top: -17px;"><a class="d" href="product-<?php echo"$p[id_produk]"; ?>-<?php echo"$p[produk_seo]"; ?>"><img width="30px" src="images/detail.png"></a></li>
								</ul>
							</li>
					    </ul>
			    	    <div class="clear"></div>
			    	</a></div>
						
					
					<?php
						}
					}
					?>
					<!-- Paging -->								
						<div class="mens-toolbar">
							<div class="pager">   
								<ul class="dc_pagination dc_paginationA dc_paginationA06" style="float:right">
									<?php echo $linkHalaman; ?>
								</ul>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</div>
				  
						<div class="clear"></div>
					</div>
					
				</div>
				<?php include('joinc/sidebar_kanan.php'); ?>
				<div class="clear"></div>
		</div>