
<?php
// Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
	WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
	$ketemu=mysql_num_rows($sql);
	if($ketemu < 1){
    echo "<script>window.alert('Keranjang Belanja masih kosong!');
        window.location=('index.php')</script>";
    }
	else
	{  
		echo "<div class='prodW'>";
		echo "<h2 class='hTitle _uppercase _big'>Keranjang Belanja</h2>
			  <form method=post action='cart.php?mod=basket&act=update'>";
		
		echo "<table  class='prodCart' width='100%'>";
			echo "<tr><thead>
					<td class='center'>No.</td>
					<td colspan='2'>Produk</td>
					<td>Jumlah</td>
					<td>Harga</td>
					<td colspan='2'>Sub Total</td>
					</thead>
				</tr><tbody>";
		$no=1;
		while($r=mysql_fetch_array($sql))
		{

			$disc        = ($r['diskon']/100)*$r['harga'];
			$hargadisc   = number_format(($r['harga']-$disc),0,",",".");
			$subtotal    = ($r['harga']-$disc) * $r['jumlah'];
			$total       = $total + $subtotal;  
			
			$subtotal_rp = format_rupiah($subtotal);
			$total_rp    = format_rupiah($total);
			$harga       = format_rupiah($r['harga']);
			$idatribut 	 = $r['id_atribut'];
			
			//get opsi atribut
			if($r['id_atribut']!=0)
			{
				$opsi = mysql_query("SELECT * FROM produk_to_opsi WHERE id_produk='$r[id_produk]' AND id_atribut='$r[id_atribut]'");
				$opsi = mysql_fetch_array($opsi);
				$gambar = "<img width='50' height='50' src=joimg/produk/opsi/s_$opsi[pic]  />";
					
				$opsiwarna = mysql_query("SELECT * FROM produk_atribut WHERE id_atribut='$r[id_atribut]'");
				$opsi_w = mysql_fetch_array($opsiwarna);
				$atribut = '- Opsi Warna: '.$opsi_w['nama_atribut'];
			}
			else { $atribut = ""; $gambar = "<img width='50' height='50'  src='joimg/produk/s_$r[gambar]'  />"; }
		   
			echo "
			<tr>
				<td class='vtop center'><b>$no.</b></td>
					<input type=hidden name=id[$no] value=$r[id_orders_temp]>
				  <td class='center vtop'>
				   <a href='produk-$r[id_produk]-$r[produk_seo].html' title='$r[nama_produk]'>
					$gambar
					</a>
				  </td>
				  <td class='left vtop'>
				  	<h1 class='prodMeta _capitalize'><b>$r[nama_produk]</b>
				  	$atribut
				  	</h1>
				  </td>
				  <td class='vtop center'> <input type=text name='jml[$no]' value=$r[jumlah] size=1 onchange=\"this.form.submit()\" onkeypress=\"return harusangka(event)\" style='outline: 1px dotted;'> </td>
				  <td class='vtop'>$hargadisc</td>
				  <td class='vtop'>$subtotal_rp</td>
				  <td class='vtop center'><a href='cart.php?mod=basket&act=del&id=$r[id_orders_temp]'>
					<img src=jolibs/images/kali.png border=0 title=Hapus></a>
				  </td>
			  </tr>";
		$no++; 
	  } 
		echo "<tr class='fBg'>
			<td></td>
			<td></td>
			<td colspan='2' style='text-align:right;padding:5px;'><b>Total:</b></td>
			<td class='price right' colspan='3' style='border-left: 1px solid #fff;'><b>Rp. $total_rp,-</b></td></tr>";
		echo "</tbody></table>";
		echo "</form>";
		echo "</div>";
	}
?>
