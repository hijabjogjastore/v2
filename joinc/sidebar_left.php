<?php

// mod kategori
echo '<div class="sb_box">';
		echo '<h2 class="hTitle _uppercase _textCenter _big">Products Category</h2>';
		echo '<div class="_inBox _textCenter">';
		include ('menu_kategori.php');
	echo '</div>';
echo '</div>';
		
//info toko
echo '<div class="sb_box">';
		echo '<h2 class="hTitle _uppercase _textCenter _big hIjow">Contact Center</h2>';
		$toko = mysql_query("SELECT * FROM mod_page WHERE id_page='6'");
		$t=mysql_fetch_array($toko);
		echo '<div class="_inBox">'.$t['isi'].'</div>';

echo '</div>';

//mod sosmed
echo '<div class="sb_box">';
	echo '<h2 class="hTitle _uppercase _textCenter _big"><font class="hIjow">On Facebook</font></h2>';
		include ('facebook.php');
echo '</div>';

//transfer pembayaran
echo '<div class="sb_box">';
	echo '<h2 class="hTitle _uppercase _textCenter _big"><font class="hIjow">Transaction</font></h2>';
	echo '<div class="_inBox _textCenter">';
		include ('bank.php');
	echo '</div>';
echo '</div>';

//box jasa pengiriman
echo '<div class="sb_box">';
	echo '<h2 class="hTitle _uppercase _textCenter _big"><font class="hIjow">Shipping</font></h2>';
	echo '<div class="_inBox _textCenter">';
		include ('pengiriman.php');
	echo '</div>';
echo '</div>';

/*
//mod-shopping-cart
echo '<div class="sb_box _textCenter">';
echo '<h2 class="hTitle _uppercase _big">Keranjang Belanja</h2>';
	include 'mycart.php';
echo '</div>';
*/

// mod customer support
/*echo '<div class="sb_box">';
		echo '<h2 class="hTitle _uppercase _textCenter _big">customer service </h2>';

		$sql = mysql_query("SELECT * FROM mod_ym");
		$cek = mysql_num_rows($sql);
		if($cek > 0){
			while($s=mysql_fetch_array($sql))
			{
				echo "<br /><div align='center'>
				<p> <a href='ymsgr:sendIM?$s[username]' title='chat dengan $s[nama]'>
              <img src='http://opi.yahoo.com/online?u=$s[username]&amp;m=g&amp;t=14' border='0' ></a> <br />
			   $s[nama] </p></div>";
			}
		} else { echo "Null";}
		echo "<br />";
echo '</div>';
*/

/*
//mod banner bank
echo '<div class="sb_box">';
	
		echo '<h2 class="hTitle _uppercase _textCenter _big">Payment</h2>';
			$bank = mysql_query("SELECT * FROM mod_bank");
			while($b=mysql_fetch_array($bank))
			{
				echo "<div class='iFloat' style='float:left; margin: 0 10px 0 10px;'>";
					echo "<img src='joimg/bank/$b[gambar]' style='width:55px;' />";
				echo "</div>";
				echo "<div class='pFloat' style='float:left;>";
					echo "<p class='_uppercase'><b>$b[nama_bank]</b></p>";
					echo "<p class='_capitalize'>no.rek: <b> $b[no_rekening] </b></p>";
					echo "<p class='_capitalize'> $b[pemilik]</p>";
				echo "</div>";
				echo "<p class='clear'></p>";
			}
echo '</div>';
*/

/*
//mod banner shipping
echo '<div class="sb_box">';
		echo '<h2 class="hTitle _uppercase _textCenter _big"><font class="hIjow">shipping</font></h2>';
		$sql = mysql_query("SELECT * FROM mod_kurir");
		$cek = mysql_num_rows($sql);
		if($cek > 0){
			echo "<div class='_inBox _textCenter'>";
			while($s=mysql_fetch_array($sql))
			{
				echo "<img src='joimg/bank/s_$s[gambar]' title='$s[nama_kurir]' border='0' >";
			}
			echo "</div>";
		} else { echo "Null"; }
		//echo "<br />";
echo '</div>';

//box cek resi pos
echo '<div class="sb_box _textCenter">';
	echo "<form method='post' action='http://www.posindonesia.co.id/add-ons/lacak-kiriman/lacakk1121m4np05.php' target='_blank'>
	<label>No. Kiriman (No. Resi) / NTP Anda :</label>
	<br /><input type='text' placeholder='Masukan Nomor' name='q' style='text-transform: uppercase; background: none repeat scroll 0% 0% #ffffff; border-width: 1px; border-style: solid; border-right: 1px solid #d9d9d9; border-color: silver #d9d9d9 #d9d9d9; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; -moz-border-image: none; color: #000000; margin: 0pt; padding: 5px 6px 5pt 6px; vertical-align: top; outline: medium none;' />
	<input type='submit' class='butt' name='cari' value='Cari Kiriman' style='height:25px; width:100px; margin-top: 2px; '/>
	</form>";
echo '</div>';
*/

/*
//box cek ongkos kirim
echo '<div class="sb_box _textCenter">';
echo '<h2 class="hTitle _uppercase _textCenter _big"><font class="hIjow">cek ongkos kirim</font></h2>';
	echo " <tr>
			<td>Tujuan</td>
			<td><select name='kota'>
			<option value='0' selected>- Pilih Kota -</option>";
			$tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota ASC");
          	while($r=mysql_fetch_array($tampil))
          	{
             	echo "<option value='$r[id_kota]'>$r[nama_kota] - $r[ongkos_kirim]</option>";
          	}
			echo '</select></td></tr>';
echo '<div class="ongkir">Harga Dapat Berubah Sewaktu-waktu</div>';
			
echo '</div>';
   	


echo '<div class="sb_box _textCenter">';
echo '<img style="width: 100px; height: 45px;" src="jolibs/images/jne1.jpeg" alt="" title="" />
    <form action="http://www.jne.co.id/index.php" method="get" name="input" target="_new2">
    <input type="hidden" name="mib" value="tracking.detail" />
    Kode: <input name="awb" type="text"  style="width: 100px;""/>
    <input type="submit" value="Cek Resi"/></form>';
echo '</div>';
*/     

?>