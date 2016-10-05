<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";
include "../../../josys/fungsi_input.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus produk
if ($module=='product' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT product_images FROM product WHERE product_id='$_GET[id]'"));
  if($data['product_images']!='') {
	
	//hapus foto dari folder
	unlink("../../../assets/images/product/$data[product_images]");
	unlink("../../../assets/images/product/s_$data[product_images]");
	mysql_query("DELETE FROM product WHERE product_id='$_GET[id]'");
	header('location:../../media.php?module='.$module);
  
  } 
	else {

	mysql_query("DELETE FROM product WHERE product_id='$_GET[id]'");
	header('location:../../media.php?module='.$module);

	}
 
}

// Input produk
elseif ($module=='product' AND $act=='input')
{
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $product_seo  = seo_title($_POST['product_name']);

	  // Apabila ada gambar yang diupload
	  if (!empty($lokasi_file))
	  {
	  	$tipe_file      = $_FILES['fupload']['type'];
		$nama_file      = $_FILES['fupload']['name'];
		$acak           = rand(1,99);
		$nama_file_unik = "hijab-jogja-store-".$product_seo."-".$acak.$nama_file; 
		UploadProduct($nama_file_unik);
		mysql_query("INSERT INTO product(product_code,
                                 product_name,
                                 product_desc,
                                 product_price,
                                 product_discount,
                                 product_promo,
                                 product_color,
                                 product_bahan,
                                 product_size,
                                 product_lama_kirim,
                                 product_jumlah,
                                 product_images,
                                 brand_id,
                                 category_id,
                                 product_seo,
                                 product_date
	                                 ) 
                        VALUES('$_POST[product_code]',
                               '$_POST[product_name]',
                               '$_POST[product_desc]',
                               '$_POST[product_price]',
                               '$_POST[product_discount]',
                               '$_POST[product_promo]',
                               '$_POST[product_color]',
                               '$_POST[product_bahan]',
                               '$_POST[product_size]',
                               '$_POST[product_lama_kirim]',
                               '$_POST[product_jumlah]',
                               '$nama_file_unik',
                               '$_POST[category]',
                               '$_POST[brand]',
                               '$product_seo',
                               '".date('Y-m-d')."')");
//echo $sql; exit;
	                                   
		//$idp = mysql_insert_id();
	  }
	  else 
	  {
				mysql_query("INSERT INTO 
							     product(product_code,
                                 product_name,
                                 product_desc,
                                 product_price,
                                 product_discount,
                                 product_promo,
                                 product_color,
                                 product_bahan,
                                 product_size,
                                 product_lama_kirim,
                                 product_jumlah,
                                 brand_id,
                                 category_id,
                                 product_seo,
                                 product_date
	                                 ) 
                        VALUES('$_POST[product_code]',
                               '$_POST[product_name]',
                               '$_POST[product_desc]',
                               '$_POST[product_price]',
                               '$_POST[product_discount]',
                               '$_POST[product_promo]',
                               '$_POST[product_color]',
                               '$_POST[product_bahan]',
                               '$_POST[product_size]',
                               '$_POST[product_lama_kirim]',
                               '$_POST[product_jumlah]',
                               '$_POST[category]',
                               '$_POST[brand]',
                               '$product_seo',
                               '".date('Y-m-d')."')");
		//$idp = mysql_insert_id();
	  }
	header('location:../../media.php?module='.$module);
 // }
}

// Update produk
elseif ($module=='product' AND $act=='update')
{
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $product_seo      = seo_title($_POST[product_name]);
  $nama_file_unik = "hijab-jogja-store-".$product_seo."-".$acak.$nama_file; 
  
  //echo $product_seo; exit;
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE product SET product_code 		= '$_POST[product_code]',
    								product_name 		= '$_POST[product_name]',
    								product_desc 		= '$_POST[product_desc]',
                                 	product_price		= '$_POST[product_price]',
                                 	product_discount	= '$_POST[product_discount]',
                                 	product_promo		= '$_POST[product_promo]',
                                 	product_color		= '$_POST[product_color]',
                                 	product_bahan		= '$_POST[product_bahan]',
                                 	product_size		= '$_POST[product_size]',
                                 	product_lama_kirim	= '$_POST[product_lama_kirim]',
                                 	product_jumlah		= '$_POST[product_jumlah]',
                                 	brand_id			= '$_POST[brand]',
                                 	category_id			= '$_POST[category]',
                                 	product_seo			= '$product_seo',
                                 	product_date		= '".date("Y-m-d")."'
                             WHERE  product_id   = '$_POST[id]'");
//echo $sql; exit;
    header('location:../../media.php?module='.$module);
  }
  else
  {
	$data=mysql_fetch_array(mysql_query("SELECT product_images FROM product  WHERE product_id='$_POST[id]'"));
	if($data['product_images']!='') 
	{
	//hapus foto dari folder
	unlink("../../../assets/images/product/$data[product_images]");
	unlink("../../../assets/images/product/s_$data[product_images]");
	
	UploadProduct($nama_file_unik);
      mysql_query("UPDATE product SET 	product_code 		= '$_POST[product_code]',
	    								product_name 		= '$_POST[product_name]',
	    								product_desc 		= '$_POST[product_desc]',
	                                 	product_price		= '$_POST[product_price]',
	                                 	product_discount	= '$_POST[product_discount]',
	                                 	product_promo		= '$_POST[product_promo]',
	                                 	product_color		= '$_POST[product_color]',
	                                 	product_bahan		= '$_POST[product_bahan]',
	                                 	product_size		= '$_POST[product_size]',
	                                 	product_lama_kirim	= '$_POST[product_lama_kirim]',
	                                 	product_jumlah		= '$_POST[product_jumlah]',
	                                 	product_images		= '$nama_file_unik',
	                                 	brand_id			= '$_POST[brand]',
	                                 	category_id			= '$_POST[category]',
	                                 	product_seo			= '$product_seo',
	                                 	product_date		= '".date("Y-m-d")."'
                             WHERE product_id   = '$_POST[id]'");
		header('location:../../media.php?module='.$module);
    }
    else 
    {
		   UploadProduct($nama_file_unik);
		   mysql_query("UPDATE product SET 	product_code 		= '$_POST[product_code]',
	    								product_name 		= '$_POST[product_name]',
	    								product_desc 		= '$_POST[product_desc]',
	                                 	product_price		= '$_POST[product_price]',
	                                 	product_discount	= '$_POST[product_discount]',
	                                 	product_promo		= '$_POST[product_promo]',
	                                 	product_color		= '$_POST[product_color]',
	                                 	product_bahan		= '$_POST[product_bahan]',
	                                 	product_size		= '$_POST[product_size]',
	                                 	product_lama_kirim	= '$_POST[product_lama_kirim]',
	                                 	product_jumlah		= '$_POST[product_jumlah]',
	                                 	product_images		= '$nama_file_unik',
	                                 	brand_id			= '$_POST[brand]',
	                                 	category_id			= '$_POST[category]',
	                                 	product_seo			= '$product_seo',
	                                 	product_date		= '".date("Y-m-d")."'
                             WHERE product_id   = '$_POST[id]'");
			header('location:../../media.php?module='.$module);
	}
  }
}



?>