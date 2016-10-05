<?php
	$sid = session_id();
		$sql = mysql_query("SELECT SUM(jumlah*harga) as total,SUM(jumlah) as totaljumlah FROM orders_temp, produk
								WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");

		while($r=mysql_fetch_array($sql)){

	  if ($r['totaljumlah'] != ""){
		 $total_rp    = format_rupiah($total);

		echo "<p class='_capitalize'> <b> $r[totaljumlah] </b>&nbsp; &nbsp; item produk</p>
			  <span class='border_cart'></span>


	<p><a href='cart'>View Cart</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='cart-step1'>Check Out</a><br /></p>";
	  }
	  else{
		echo "<p class='_capitalize'>0 item produk</p>
			  <span class='border_cart'></span>";
	  }
	  }

?>
