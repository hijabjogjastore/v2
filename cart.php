<?php
session_start();
ob_start();
//error_reporting(0);
include "josys/koneksi.php";
include "josys/library.php";
include "josys/fungsi_input.php";

$mod=$_GET['mod'];
$act=$_GET['act'];

if ($mod=='basket' AND $act=='add')
{

	$sid  = session_id();
	$id   = cleanInput(@$_GET['idp']);
	$opsiwarna = cleanInput(@$_GET['ido']);
	$sql  = mysql_query("SELECT stok FROM product WHERE product_id='$id'");
	$s 	  = mysql_fetch_array($sql);
	$stok = $s['stok'];
  if ($stok == "0"){ echo "stok habis"; }
  else
  {
	if($opsiwarna!="0")
	{
		//echo $opsiwarna;
		// check if the product is already in cart table for this session
		$sql = mysql_query("SELECT product_id FROM orders_temp
				WHERE product_id='$id' AND id_atribut='$opsiwarna' AND id_session='$sid'");
		$ketemu=mysql_num_rows($sql);
		if ($ketemu=="0")
		{
			// put the product in cart table
			mysql_query("INSERT INTO orders_temp (product_id,id_atribut, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp)
			VALUES ('$id','$opsiwarna', 1, '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");
		}
		else 
		{
			// update product quantity in cart table
			mysql_query("UPDATE orders_temp 
			        SET jumlah = jumlah + 1
					WHERE id_session ='$sid' AND product_id='$id' AND id_atribut='$opsiwarna'");		
		}
		deleteAbandonedCart();
		header('location: cart');
	}
	else 
	{
		// check if the product is already in cart table for this session
		$sql = mysql_query("SELECT product_id FROM orders_temp
				WHERE product_id='$id' AND id_session='$sid'");
		$ketemu=mysql_num_rows($sql);
		if ($ketemu=="0")
		{
			// put the product in cart table
			mysql_query("INSERT INTO orders_temp (product_id, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp)
			VALUES ('$id', 1, '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");
		}
		else 
		{
			// update product quantity in cart table
			mysql_query("UPDATE orders_temp 
			        SET jumlah = jumlah + 1
					WHERE id_session ='$sid' AND product_id='$id'");		
		}
		deleteAbandonedCart();
		header('location: cart');
	}
  }				
}

elseif ($mod=='basket' AND $act=='del')
{
	mysql_query("DELETE FROM orders_temp WHERE id_orders_temp='$_GET[id]'");
	header('Location:cart');				
}

elseif ($mod=='basket' AND $act=='update')
{
  $id       = $_POST['id'];
  $jml_data = count($id);
  $jumlah   = $_POST['jml']; // quantity
  for ($i=1; $i <= $jml_data; $i++)
  {
	$sql2 = mysql_query("SELECT stok_temp FROM orders_temp	WHERE id_orders_temp='".$id[$i]."'");
	while($r=mysql_fetch_array($sql2))
	{
		if ($jumlah[$i] > $r['stok_temp'])
		{
			echo "<script>window.alert('Jumlah yang dibeli melebihi stok yang ada');
			window.location=('cart')</script>";
		}
		elseif($jumlah[$i] == 0)
		{
			echo "<script>window.alert('Anda tidak boleh menginputkan angka 0 atau mengkosongkannya!');window.location=('cart')</script>";
		} // tambahan update ada disini
		else
		{
			mysql_query("UPDATE orders_temp SET jumlah = '".$jumlah[$i]."'
			WHERE id_orders_temp = '".$id[$i]."'");
			header('Location:cart');
		}
	}
  }
}


//pre order
elseif($mod=='basket' AND $act=='preorder')
{
	header('Location:pre-order');
}


/*
	Delete all cart entries older than one day
*/
function deleteAbandonedCart(){
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysql_query("DELETE FROM orders_temp 
	        WHERE tgl_order_temp < '$kemarin'");
}
?>
