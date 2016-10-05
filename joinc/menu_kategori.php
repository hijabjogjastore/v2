<div class="col col-4" style="padding: 0px;">								
	<div id="cssmenuv">
		<ul>
			<?php
			$kategori=mysql_query("SELECT * FROM kategori ORDER BY id_kategori ASC");
			while($sk=mysql_fetch_array($kategori)){	
														
			$subkategori=mysql_query("SELECT * FROM subkategori WHERE id_kategori = $sk[id_kategori] ORDER BY nama ASC");
			$ka = mysql_num_rows($subkategori);
				if($ka == 0){
			?>
			<li>
				<a href='<?php echo"$sk[id_kategori]"; ?>-kategori-<?php echo"$sk[seo]"; ?>'><span><?php echo"$sk[nama]"; ?></span></a>
			</li>
			<?php
				}else{
			?>
			<li class='has-sub'><a href='<?php echo"$sk[id_kategori]"; ?>-kategori-<?php echo"$sk[seo]"; ?>'><span><?php echo"$sk[nama]"; ?></span></a>
				<ul>
					<?php
						while($k=mysql_fetch_array($subkategori)){	
					?>
					<li>
						<a href='<?php echo"$k[id_subkategori]"; ?>-subkategori-<?php echo"$k[seo]"; ?>'><span><?php echo"$k[nama]"; ?></span></a>
					</li>
					<?php } ?>
				</ul>
			</li>
			<?php }} ?>
		</ul>
		<!--
		<ul>
			<li><a href="#"><span>JILBAB PESTA</span></a></li>
			<li class="has-sub"><a href="#"><span>JILBAB BERGO</span></a>
				<ul>
					<li><a href="#"><span>BAHAN KAOS TUTON</span></a></li>
					<li><a href="#"><span>BAHAN SPANDEK NILON</span></a></li>
				</ul>
			</li>
			<li><a href="#"><span>JILBAB CANTIK MODIS</span></a></li>
			<li><a href="#"><span>PASHMINA</span></a></li>
			<li><a href="#"><span>PELENGKAP KERUDUNG</span></a></li>
			<li><a href="#"><span>TURBAN</span></a></li>
			<li><a href="#"><span>JILBAB ANAK</span></a></li>
			<li><a href="#"><span>ACCESSORIES</span></a></li>
			<li><a href="#"><span>GAMIS</span></a></li>
			<li><a href="#"><span>KERUDUNG SEGIEMPAT</span></a></li>
			<li><a href="#"><span>KERUDUNG SEGITIGA</span></a></li>
			<li><a href="#"><span>MUKENA CANTIK</span></a></li>
			<li class="has-sub"><a href="#"><span>KATALOG WARNA</span></a>
				<ul>
					<li><a href="#"><span>KATALOG WARNA KAOS TUTON</span></a></li>
					<li><a href="#"><span>KATALOG WARNA NILON</span></a></li>
				</ul>
			</li>											
		</ul>-->
	</div>
</div>