<?php  
//menu          
$sql=mysql_query("SELECT * FROM modul WHERE aktif='Y' AND menu='modul' ORDER BY id_modul ASC");
	while($s=mysql_fetch_array($sql))
	{  
		echo "<li><a href='$s[link]'><b>$s[nama_modul]</b></a></li>";
	}	
		
	echo "</li>";
