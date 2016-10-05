<li><a href='?module=home'><b>home</b></a></li>
<?php  
//menu          
$sql=mysql_query("SELECT * FROM modul WHERE aktif='Y' AND menu='utama' ORDER BY id_modul ASC");
	while($s=mysql_fetch_array($sql))
	{  
		echo "<li><a href='$s[link]'><b>$s[nama_modul]</b></a></li>";
	}	
	echo "<li><a href='?module=user&act=edituser&id=$_SESSION[idsesi]'><b>USER</b></a></li>";
	echo "</li>";
