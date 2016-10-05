<?php
@session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_product/aksi_product.php";

switch(@$_GET['act']){

//Tampil Produk
    default:
    echo "<h2 class='hLine'>Product</h2>
          <input type=button class='butt' value='Tambah Product' onclick=\"window.location.href='?module=product&act=tambahproduct';\">
          <table class='list' id='listTable'>
          <thead>
			  <tr>
				<th class='center'>No.</td>
				<th class='center'>Images</td>
				<th class='center'>Nama Produk</td>
				<th class='center'>Harga</td>
				<th class='center'>Brand</td>
				<th class='center'>Kategori Produk</td>
				<th class='center'>Aksi </td>
				
			  </tr>
		  </thead>";

    $tampil = mysql_query("SELECT * FROM product ORDER BY product_id DESC");
  
    $no = 1;
    while($r=mysql_fetch_array($tampil))
    {
      $harga=format_rupiah($r['product_price']);
	  
	  //get kategori 
	  $kat=mysql_query("SELECT * FROM category WHERE category_id='$r[category_id]'");
	  $k=mysql_fetch_array($kat);
	  $brand=mysql_query("SELECT * FROM brand WHERE brand_id='$r[brand_id]'");
	  $data_brand=mysql_fetch_array($brand);
      echo "<tr><td>$no.</td>
       			<td class='left  _capitalize'><img src='../assets/images/product/s_$r[product_images]'></td>
                <td class='left  _capitalize'>$r[product_name]</td>
                <td class='left'>Rp. $harga</td>
                <td class='left'>$data_brand[brand_name]</td>
                <td class='left'>$k[category_name]</td>";
          
		        echo "<td>
					<p>
						<a href=?module=product&act=editproduct&id=$r[product_id]><img src='images/add-icon.gif' title='Edit Detail' /></a>
						&nbsp;&nbsp;
						<a href=$aksi?module=product&act=hapus&id=$r[product_id]><img src='images/hr.gif' title='Hapus' /></a>
						&nbsp;&nbsp;
						<a href=?module=subimages&id=$r[product_id]><img src='images/images.png' title='images' /></a>
					</p>
					</td>
		        </tr>";
      $no++;
    }
    echo "</table>";
	//echo pagination($table,$limit,$page, $url);
    break;
  
  
//Tambah Produk Disini
    case "tambahproduct":
    echo "<h2 class='hLine'><a href='?module=product'>Produk</a> &raquo; Tambah Produk</h2>
          <form method=POST action='$aksi?module=product&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td width=100 class='left'>Kode Produk</td>
			<td class='left'><input class='msgBox' type=text name='product_code'  size=60></td>
		  </tr>
          <tr>
			<td width=100 class='left'>Nama Produk</td>
			<td class='left'><input class='msgBox' type=text name='product_name' size=60></td>
		  </tr>
          <tr>
			<td class='left'>Brand</td>
			<td class='left'>";
			$tampil=mysql_query("SELECT * FROM brand ORDER BY brand_name");
            $cek=mysql_num_rows($tampil);
				if($cek<='0'){ 
					echo "<b style='color:red;'>Belum ada Brand!</b>";
				} else {
							echo "<select name='brand'><option value=0 selected>- Pilih Brand -</option>";
							
							while($r=mysql_fetch_array($tampil))
							{
								echo "<option value=$r[brand_id]>$r[brand_name]</option>";				
							}
							echo "</select>";
						}
	echo "</td>
		</tr>
		 <tr>
			<td class='left'>Kategori</td>
			<td class='left'>";
			$tampil_category=mysql_query("SELECT * FROM category ORDER BY category_name");
            $cek_category=mysql_num_rows($tampil_category);
				if($cek<='0'){ 
					echo "<b style='color:red;'>Belum ada Kategori Produk!</b>";
				} else {
							echo "<select name='category'><option value=0 selected>- Pilih Kategori -</option>";
							
							while($data_category=mysql_fetch_array($tampil_category))
							{
								echo "<option value=$data_category[category_id]>$data_category[category_name]</option>";				
							}
							echo "</select>";
						}
	echo "</td>
		</tr>
          <tr>
			<td class='left'>Harga</td>
			<td class='left'><input class='msgBox' type='text'  name='product_price' size=55 maxlength=10> * Penulisan harga tanpa tanda (.) titik</td></tr>
		<tr>
			<td class='left'>Diskon</td>
			<td class='left'><input  type='text'  name='product_discount' size=55 maxlength=10> * Penulisan harga tanpa tanda (.) titik</td></tr>
			
		<tr>
			<td class='left'>Promo</td>
			<td class='left'><input class='msgBox' type='text'  name='product_promo' size=55 maxlength=10> * Penulisan harga tanpa tanda (.) titik</td></tr>
		<tr>
			<td class='left'>Warna</td>
			<td class='left'><input class='msgBox' type='text'  name='product_color' size=55 maxlength=10> * Penulisan harga tanpa tanda (.) titik</td></tr>
		<tr>
			<td class='left'>Bahan</td>
			<td class='left'><input class='msgBox' type='text'  name='product_bahan' size=55 maxlength=10> * Penulisan harga tanpa tanda (.) titik</td></tr>
				
		<tr>
			<td class='left'>Ukuran</td>
			<td class='left'><input class='msgBox' type='text'  name='product_size' size=55 maxlength=10> * Penulisan harga tanpa tanda (.) titik</td></tr>
		<tr>
			<td class='left'>Pengiriman</td>
			<td class='left'><input class='msgBox' type='text'  name='product_lama_kirim' size=55 maxlength=10> * Penulisan harga tanpa tanda (.) titik</td></tr>
		<tr>
			<td class='left'>Jumlah</td>
			<td class='left'><input class='msgBox' type='text'  name='product_jumlah' size=55 maxlength=10> * Penulisan harga tanpa tanda (.) titik</td></tr>
			
		 <tr>
			<td class='left'>Deskripsi</td>  
			<td><textarea  name='product_desc' style='width: 100%; height: 350px;'></textarea></td></tr>
          <tr>
			<td class='left'>Gambar</td>
			<td class='left'><input type=file name='fupload' size=40> <br />Tipe gambar harus JPG/JPEG, Rekomendasi ukuran lebar dan tinggi gambar: 500x600 px</td>
		  </tr>
          <tr>
			<td colspan=2 class='left'>
			<input type=submit class='butt' value=Simpan>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td>
		  </tr>
          </table></form>";
     break;
    



    ///////////////////////////////////////////////////////////////////////////////////////EDIT PRODUCT/////////////////////////////////////////////
    case "editproduct":
    $edit = mysql_query("SELECT * FROM product WHERE product_id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	
	//$tanggal=tgl_indo($r['tgl_masuk']);
	
    echo "<h2 class='hLine'><a href='?module=produk'>Produk</a> &raquo; Edit $r[nama_produk]</h2>";
    echo "<table class='list'>";
     //tanggal masuk
	echo "<tr><td class='left' width='100'>Tanggal Masuk</td><td class='left'>$r[product_date]</td></tr></table>"; 
	
    //produk to opsi
    
    echo "<h2 class='hLine'>Detail Produk</h2>";
    echo "<form method=POST enctype='multipart/form-data' action=$aksi?module=product&act=update>
          <input type=hidden name=id value=$r[product_id]>
          <table class='list'>";
	//nama produk
    echo "<tr>
			<td class='left' width=120>Kode Produk</td>
			<td class='left'><input class='msgBox' size='60' type=text name='product_code' size=60 value='$r[product_code]'></td>
		  </tr>";
		  
	echo "<tr>
			<td class='left' width=120>Nama Produk</td>
			<td class='left'><input class='msgBox' size='60' type=text name='product_name' size=60 value='$r[product_name]'></td>
		  </tr>";
		  
	
	
	//Sub Kategori
	echo   "<tr>
			<td class='left'>Brand</td>
			<td class='left'><select name='brand'>";
 
          $tampil_brand=mysql_query("SELECT * FROM brand ORDER BY brand_name");
          if ($r['brand_id']==0){
            echo "<option value=0 selected>- Pilih Brand -</option>";
          }   
          while($w=mysql_fetch_array($tampil_brand)){
            if ($r['brand_id']==$w['brand_id']){
              echo "<option value=$w[brand_id] selected>$w[brand_name]</option>";
            }
            else{
              echo "<option value=$w[brand_id]>$w[brand_name]</option>";
            }
          }
    echo "</select></td></tr>";
		//kategori
    echo   "<tr>
			<td class='left'>Kategori</td>
			<td class='left'><select name='category'>";
 
          $tampil=mysql_query("SELECT * FROM category ORDER BY category_name");
          if ($r['id_kategori']==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   
          while($w=mysql_fetch_array($tampil)){
            if ($r['category_id']==$w['category_id']){
              echo "<option value=$w[category_id] selected>$w[category_name]</option>";
            }
            else{
              echo "<option value=$w[category_id]>$w[category_name]</option>";
            }
          }
    echo "</select></td></tr>";
	//harga
    echo "<tr>
			<td class='left'>Harga</td>
			<td  class='left'><input class='msgBox' id='angka' type='text' name='product_price' value='$r[product_price]' size='50' maxlength=10/> * Penulisan harga tanpa tanda (.) titik </td>
		  </tr>
		<tr>
			<td class='left'>Diskon</td>
			<td class='left'><input  type='text'  name='product_discount' value='$r[product_discount]' size='55' maxlength=10> * Penulisan harga tanpa tanda (.) titik</td></tr>
			
		<tr>
			<td class='left'>Promo</td>
			<td class='left'><input class='msgBox' type='text'  name='product_promo' value='$r[product_promo]' size='55' maxlength='10'> * Penulisan harga tanpa tanda (.) titik</td></tr>
		<tr>
			<td class='left'>Warna</td>
			<td class='left'><input class='msgBox' type='text'  name='product_color' size='55' maxlength='10' value='$r[product_color]'> * Penulisan harga tanpa tanda (.) titik</td></tr>
		<tr>
			<td class='left'>Bahan</td>
			<td class='left'><input class='msgBox' type='text'  name='product_bahan' size='55' maxlength='10' value='$r[product_bahan]'> * Penulisan harga tanpa tanda (.) titik</td></tr>
				
		<tr>
			<td class='left'>Ukuran</td>
			<td class='left'><input class='msgBox' type='text'  name='product_size' size='55' maxlength='10' value='$r[product_size]'> * Penulisan harga tanpa tanda (.) titik</td></tr>
		<tr>
			<td class='left'>Pengiriman</td>
			<td class='left'><input class='msgBox' type='text'  name='product_lama_kirim' size='55' maxlength='10' value='$r[product_lama_kirim]'> * Penulisan harga tanpa tanda (.) titik</td></tr>
		<tr>
			<td class='left'>Jumlah</td>
			<td class='left'><input class='msgBox' type='text'  name='product_jumlah' size='55' maxlength='10' value='$r[product_jumlah]'> * Penulisan harga tanpa tanda (.) titik</td></tr>
			
		 <tr>
          <tr>
			<td  class='left'>Deskripsi</td>
			<td> <textarea name='product_desc' style='width: 350px; height: 350px;'>$r[product_desc]</textarea></td>
		  </tr>";
		 
    //gambar
	echo "<tr>
			<td  class='left'>Gambar</td>
			<td  class='left'>  
			<img src='../assets/images/product/s_$r[product_images]'></td>
		  </tr>
          <tr>
			<td  class='left'>Ganti Gbr</td>
			<td  class='left'><input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2  class='left'>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2  class='left'>
			<input type=submit class='butt' value=Update>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}//end switch

}//end if else
?>
