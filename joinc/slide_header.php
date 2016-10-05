<?php
	$sql = mysql_query("SELECT * FROM mod_header ORDER BY id_slider DESC");
	while ($s=mysql_fetch_array($sql))
	{
		echo "<img src='joimg/slides/$s[gambar]' border='0'></a>";
	}
?>