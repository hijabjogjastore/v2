<?php
//alamat
	$sql= mysql_query("SELECT * FROM mod_page WHERE id_page='8'");
		$s=mysql_fetch_array($sql);
		echo '<div class="_inBox">'.$s['isi'].'</div>';