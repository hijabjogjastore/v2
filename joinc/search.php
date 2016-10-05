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
					echo '<h2 class="hTitle _uppercase _big">Search Result</h2>';
						// menghilangkan spasi di kiri dan kanannya
							$kata = trim($_POST['cari']);
								if(!empty($kata)){
						
						// pisahkan kata per kalimat lalu hitung jumlah kata
							$pisah_kata = explode(" ",$kata);
							$jml_katakan = (integer)count($pisah_kata);
							$jml_kata = $jml_katakan-1;

							$cari = "SELECT * FROM produk WHERE " ;
							for ($i=0; $i<=$jml_kata; $i++){
							$cari .= "nama_produk LIKE '%$pisah_kata[$i]%'";
							if ($i < $jml_kata ){
							$cari .= " OR ";
								}
							}
											  
							$cari .= " ORDER BY id_produk DESC LIMIT 21";
							$hasil  = mysql_query($cari);
							$ketemu = mysql_num_rows($hasil);

							if ($ketemu > 0){
							
							echo "<div class='prodMeta _textLeft'>
									<strong>
									<p class='_capitalize pTitle'>
										Ditemukan <b>$ketemu</b> produk
									</p>
									</strong>
								</div>";
							while($t=mysql_fetch_array($hasil)){
								echo "<div class='prodBox _textLeft'>
											<div class='prodImg _textLeft'>
												<img class='prodBox _textLeft' src='joimg/produk/$t[gambar]' alt='$t[seo]'>
												<a href='produk-$t[id_produk]-$t[produk_seo].html'>$t[nama]</a>
											</div>
											<div class='prodMeta _textLeft'>
												<strong>
												<p class='_capitalize pTitle'>
													<a href='produk-$t[id_produk]-$n[produk_seo].html'>$t[nama_produk]</a>
												</p>
												</strong>
											</div>
									</div>";
								}                                                          
							}
							else{
								echo "<div class='prodMeta _textLeft'>
												<strong>
												<p class='_capitalize pTitle'>
													Tidak ditemukan produk dengan nama <b>$kata</b>
												</p>
												</strong>
									</div>";
							}

							}
							else{
									echo "<div class='prodMeta _textLeft'>
												<strong>
												<h3 style='color:red;'>Warning!</h3>	
												<p class='_capitalize pTitle'>
													Kata pencarian belum diisi !
												</p>
												</strong>
										</div>";
							}
					?>

</div>	
