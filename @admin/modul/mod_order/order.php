<?php
@session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_order/aksi_order.php";
switch(@$_GET['act']){
  // Tampil Order
  default:
    echo "<form action=modul/mod_order/aksi_alldel.php method=POST>";
    echo "<h2 class='hLine'>Order Masuk</h2>
          <table class='list' id='listTable'>
          <thead>
          <tr>
          	<td class='center'>#</td>
          	<td class='center'>No.Order</td>
          	<td class='center'>Nama Konsumen</td>
          	<td class='center'>Tgl. Order</td>
          	<td class='center'>Jam</td>
          	<td class='center'>Status</td>
          	<td class='center'>Aksi</td>
          </tr></thead>";

    $tampil = mysql_query("SELECT * FROM orders ORDER BY id_orders DESC");
    $no=0;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r['tgl_order']);	  
      echo "<tr><td><input type=checkbox name=cek[] value=$r[id_orders] id=id$no></td>
	              <td >$r[id_orders]</td>
                       <td>$r[nama_kustomer]</td>
		     <td>$tanggal</td>
                       <td>$r[jam_order]</td>
                      <td>$r[status_order]</td>
		    <td><a href=?module=order&act=detailorder&id=$r[id_orders]><b>Baca</b></a> | 
		            <a href=$aksi?module=order&act=hapus&id=$r[id_orders]><b>Hapus</b></a></td></tr>";
      $no++;
    }
	echo "</table>";
	echo "<table>";      
    echo "<tr><td colspan='7' class='left'>
	<input type=radio name=pilih onClick='for (i=0;i<$no;i++){document.getElementById(\"id\"+i).checked=true;}'>Check All 
	<input type=radio name=pilih onClick='for (i=0;i<$no;i++){document.getElementById(\"id\"+i).checked=false;}'>Uncheck All
	</td></tr>
	<tr><td colspan='7' class='left'><input type=submit class='butt' value=Hapus></td>
	</tr></table></form>";
    break;
  
    
  case "detailorder":
    $edit = mysql_query("SELECT * FROM orders WHERE id_orders='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    $tanggal=tgl_indo($r['tgl_order']);

    $pilihan_status = array('Batal','Lunas/Terkirim');
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r['status_order']) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }

    echo "<h2 class='hLine'>Detail Order</h2>
          <form method=POST action=$aksi?module=order&act=update>
          <input type=hidden name=id value=$r[id_orders]>
          <table class='list'>
          <tr>
			<td class='left'>No. Order</td>
			<td class='left'> : $r[id_orders]</td>
		  </tr>
          <tr>
			<td class='left'>Tgl. & Jam Order</td>
			<td class='left'> : $tanggal & $r[jam_order]</td></tr>
          <tr>
			<td class='left'>Status Order</td>
			<td class='left'>: <select name=status_order>$pilihan_order</select>
				<input class='butt' type='submit' value='Ubah Status'></td></tr>
          </table></form>";

  // tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM orders_detail, product
                     WHERE orders_detail.product_id=product.product_id 
                     AND orders_detail.id_orders='$_GET[id]'");
//echo $sql; exit;
  
  echo "<table class='list'>
       <thead>
       <tr>
       	<th class='center'>Nama Produk</th>
       	<th class='center'>Jumlah</th>
       	<th class='center'>Harga Satuan</th>
       	<th class='center'>Sub Total</th></tr> </thead>";
  
  while($s=mysql_fetch_array($sql2))
  {
	$subtotal    = $s['product_price'] * $s['jumlah'];
    $subtotal_rp = format_rupiah($subtotal);
    
    $total       = @$total + $subtotal;  
    $total_rp    = format_rupiah($total);    
    
    $harga       = format_rupiah($s['product_price']);
	
	//get opsi atribut
	if($s['id_atribut']>0)
	{
		$atrib = mysql_fetch_array(mysql_query("SELECT * FROM produk_atribut WHERE id_atribut='$s[id_atribut]'"));
		$atribut = " - opsi warna: $atrib[nama_atribut]";
	} else { $atribut = ""; }
	
    echo "<tr>
		<td class='left _capitalize'>$s[product_name] $atribut</td>
		<td>$s[jumlah]</td>
		<td>Rp. $harga</td>
		<td class='right'>Rp. $subtotal_rp</td></tr>";
  }

  	//ongkos kirim kota
	$idkota = $r['id_kota'];
	$ongkir = mysql_query("SELECT * FROM kota WHERE id_kota='$idkota'");
	$o = mysql_fetch_array($ongkir);
	$ongkos = $o['ongkos_kirim'];
	$ongkos_rp = format_rupiah($ongkos);
	
  	$grandtotal    = $total + $ongkos; 
 	$grandtotal_rp  = format_rupiah($grandtotal); 

	echo "<tr>
		<td colspan=3 class='right'>Total : </td>
			<td class='right'>Rp. <b>$total_rp</b></td></tr>    
     <tr>
     <td colspan='3' class='right'>Ongkos Kirim : </td>
     <td class='right'>Rp. <b>$ongkos_rp</b></td>
     </tr>
	  <tr>
		<td colspan=3 class='right'>Grand Total : </td>
			<td class='right'>Rp. <b>$grandtotal_rp</b></td></tr>
      </table>";

  // tampilkan data kustomer
  echo "<table class='list'>
        <tr><th colspan=2>Data Kustomer</th></tr>
        <tr>
			<td class='left' width='180'>Nama Pembeli</td>
			<td class='left'> : $r[nama_kustomer]</td></tr>
        <tr>
			<td class='left'>Alamat Pengiriman</td>
			<td class='left'> : $r[alamat]</td></tr>
        <tr>
			<td class='left'>No. Telpon/HP</td>
			<td class='left'> : $r[telpon]</td></tr>
        <tr>
			<td class='left'>Email</td>
			<td class='left'> : $r[email]</td></tr>
	<tr>
		<td class='left'>Nama Barang</td>
		<td class='left'>: $r[namabarang]</td>
	</tr>
        </table>";
    
	
	case "kiriminvoice":        

    echo "<h2 class='hLine'>Kirim Faktur Pembelian</h2>
          <form method=POST action='?module=order&act=kirimemail'>
          <table>
          <tr><td>Kepada</td><td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr><td>Subjek</td><td> : <input type=text name='subjek' size=50 value='Faktur Pembelian'></td></tr>
          <tr><td>Pesan</td><td>
		  <textarea name='pesan' style='height: 450px;' id='jogmce'>	  
		  <p>Dengan ini, Kami sampaikan bahwa kami telah menerima pembayaran order, dan pesanan anda telah kami kirim.</p>
  --------------------------------------------------------------------------------------
		   <p>Detail:</p><br/>
		  <p>No. Order: $r[id_orders]</p>
		  <p>Atas nama: $r[nama_kustomer]</p> 
		  <p>Total pembayaran sebesar <b> Rp. $grandtotal_rp </b></p>
		  <p>Alamat pengiriman: $r[alamat]</p><br/>
		  <p>Terima kasih telah belanja di Toko Online kami...</p>>  
  --------------------------------------------------------------------------------------
  </textarea></td></tr>
          <tr><td colspan=2><input type='submit' value='Kirim' class='butt' />
                            <input type='button' class='butt' value='Batal' onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "kirimemail":
        $dari = "From: TasTenunjogja.com\n";
		$dari .= "MIME-Version: 1.0\r\n";
		$dari .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($_POST['email'],$_POST['subjek'],$_POST['pesan'],$dari);
    echo "<h2>Status Email</h2>
          <p>Email telah sukses terkirim ke tujuan</p>
          <p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p>";	 		  
    break;  
 }
}
?>
