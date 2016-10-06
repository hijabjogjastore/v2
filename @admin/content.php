<?php
// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
	echo "<div class='box-header'>
        <p>Hai admin <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator.
        Gunakan menu di <b style='font-size: 13px;'> sidebar kiri </b> anda untuk mengelola konten website.</p></div>";
	echo "<div class='box-body clear'>";
	
//pesan selamat datang
$aksi="modul/mod_page/aksi_page.php";
$sql=mysql_query("SELECT * FROM mod_page WHERE id_page='1'");
$s=mysql_fetch_array($sql);
	/*echo "<h2 class='hLine'>Welcome to Zonatifosi:</h2>
	<p>Anda bisa mengubah <b> pesan selamat datang</b> yang ditampilkan di halaman depan <i>(home)</i> website, melalui teks area dibawah.</p>
	<form method='POST' action='$aksi?module=page&act=update'>
	<input type=hidden name='id' value='$s[id_page]' />
	<input type='hidden' name='judul' value='$s[judul]' />
	<table class='list'>
	<tr>
	<td colspan='2'><textarea name='isi_halaman' id='jogmce' style='height:400px;'>$s[isi]</textarea></td>
	</tr>
	<tr>
		<td class='center' > SEO Description</td>
		<td class='left'>
			<textarea name='meta_deskripsi' class='msgBox'>$s[meta_deskripsi]</textarea>
		</td>
	</tr>
	<tr>
		<td class='center' > SEO Keyword </td>
		<td class='left'><input type='text' name='keyword' class='msgBox' value='$s[meta_keyword]' size='100'></td>
	</tr>
	<tr></tr>
	<tr>
		<td class='left' colspan='2'><input type='submit' class='butt' value='Update' /></td>
	</tr>
	</table>
	</form>";*/
	
//informasi kontak sidebar
/*$sql2=mysql_query("SELECT * FROM mod_page WHERE id_page='6'");
$s2=mysql_fetch_array($sql2);
	echo "<h2 class='hLine'>Informasi Kontak (sidebar):</h2>
	<p>Anda bisa mengubah isi <b> informasi </b> yang ditampilkan di sidebar halaman website, melalui teks area dibawah.</p>
	<form method='POST' action='$aksi?module=page&act=update'>
	<input type=hidden name='id' value='$s2[id_page]' />
	<input type='hidden' name='judul' value='$s2[judul]' />
	<table class='list'>
	<tr>
	<td><textarea name='isi_halaman' id='jogmce2' style='height:400px;'>$s2[isi]</textarea></td>
	</tr>
	<tr>
		<td class='left'><input type='submit' class='butt' value='Update' /></td>
	</tr>
	</table>
	</form>";


	  echo "<p align=right>Login : $hari_ini, ";
	  echo tgl_indo(date("Y m d")); 
	  echo " | "; 
	  echo date("H:i:s");
	  echo " WIB</p>";*/
	  echo " </div>";
  }
  elseif ($_SESSION['leveluser']=='user'){
  echo "<div class='box-header clear'>
		<h2>Selamat Datang</h2>
		</div>
		<div class='box-body clear'>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator<br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website. </p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>


          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  echo "</div>";
 	}
}


//main menu
elseif($_GET['module']=='menu'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_menu/menu.php";
	}
}

//mod brand
//kategori
elseif($_GET['module']=='brand'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_brand/brand.php";
	}
}

//category
elseif($_GET['module']=='category'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_category/category.php";
	}
}

//product 
elseif($_GET['module']=='product'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_product/product.php";
	}
}

//mod ym chat
elseif($_GET['module']=='ym'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_ym/ym.php";
	}
}

//mod fb
elseif($_GET['module']=='fb'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_fb/fb.php";
	}
}

//mod information
elseif($_GET['module']=='information'){
	if($_SESSION['leveluser']=='admin')
	{
		//echo "Informasi";
		include "modul/mod_information/information.php";
	}
}
//mod download
elseif($_GET['module']=='download'){
	if($_SESSION['leveluser']=='admin')
	{
		//echo "Informasi";
		include "modul/mod_download/download.php";
	}
}
//subcribe
elseif($_GET['module']=='subcribe'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_subcribe/subcribe.php";
	}
}

//user
elseif($_GET['module']=='user'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_user/users.php";
	}
}

//mod bank
elseif($_GET['module']=='bank')
{
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_bank/bank.php";
	}
}

//mod Sub Images
elseif($_GET['module']=='subimages'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_subimages/subimages.php";
	}
}

//mod kurir
elseif($_GET['module']=='kurir')
{
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_kurir/kurir.php";
	}
}
//mod news
elseif($_GET['module']=='news')
{
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_news/news.php";
	}
}
//mod album
elseif($_GET['module']=='album')
{
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_album/album.php";
	}
}
//mod galeri
elseif($_GET['module']=='galeri')
{
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_galeri/galeri.php";
	}
}
//mod testimoni
elseif($_GET['module']=='testimoni')
{
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_testimoni/testimoni.php";
	}
}

//mod page
elseif($_GET['module']=='page'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_page/page.php";
	}
}

//home-slideshow
elseif($_GET['module']=='slider'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_slider/slider.php";
	}
}

//header slideshow
elseif($_GET['module']=='header'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_header/header.php";
	}
}
//produk contoh faksjfasuyrfgsdmnbdsiu kjsadgfsadkjf bsnv fgasjdfb sadm fsdafmasdgbf
elseif($_GET['module']=='produk'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_produk/produk.php";
	}
}


//ongkir kota
elseif($_GET['module']=='ongkir'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_ongkir/ongkir.php";
	}
}

//order
elseif($_GET['module']=='order'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_order/order.php";
	}
}

//sosial media
elseif($_GET['module']=='sosmed'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_sosial/sosial.php";
	}
}

//shoutbox
elseif($_GET['module']=='shoutbox'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_shoutbox/shoutbox.php";
	}
}

//kategori
elseif($_GET['module']=='kategori'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_kategori/kategori.php";
	}
}

//subkategori
elseif($_GET['module']=='subkategori'){
	if($_SESSION['leveluser']=='admin')
	{
		include "modul/mod_subkategori/subkategori.php";
	}
}

//proses form cari
elseif($_GET['mod']=='form_cari'){
  
  // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST['search']);
  // mencegah XSS
  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;
  
  $katb = $_POST['katprod'];
  echo "
  	<div style='padding: 0 10px; line-height: 20px;' class='mBox'>";
	if($_POST['search']=='Kata kunci...' || $_POST['search']=='')
			{
				echo "<script>window.alert('Silahkan ketikan kata kunci pencarian terlebih dahulu.');window.location(history.back(-1))</script>";
			}
			
	if($_POST['katprod']=='0')
	{
			$cari = "SELECT * FROM produk WHERE " ;
				for ($i=0; $i<=$jml_kata; $i++){
					$cari .= "nama_produk LIKE '%$pisah_kata[$i]%' ";
					if ($i < $jml_kata ){
						$cari .= " AND ";
					  }
				}
				  $cari .= " ORDER BY id_produk";
				  $hasil  = mysql_query($cari);
				  $ketemu = mysql_num_rows($hasil);
				
				
				echo "<h1 class='hTitle _capitalize'>hasil pencarian</h1>";
				  if ($ketemu > 0)
				  {	 
					
					echo "<p class='_capitalize'>kata kunci &raquo; <b style='color:#7A0503'> $kata </b>, <b style='color:#7A0503'> semua kategori </b></p>";
					while($b=mysql_fetch_array($hasil))
					{
					
						//get kategori produk
						$kat=mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$b[id_kategori]'");
						$k=mysql_fetch_array($kat);
								
						$harga 		= format_rupiah($b['harga']);
						$linkBeli 	= 'addcart&idp='.$b['id_produk'];
						$divharga = '<font style="color: #C65159;">Rp. '.$harga.' ,-</font>';
						
						echo "<div class='divIprod _capitalize'>
								<h1><a href='produk-$b[id_produk]-$b[produk_seo].html' title='$b[nama_produk]'>$b[nama_produk]</a> </h1>
								<a href='produk-$b[id_produk]-$b[produk_seo].html' title='$b[nama_produk]'><img class='iProdPic' src='joimg/produk/$b[gambar]' width='220px' /></a>
							</div>
							<div class='divTprod'>
								<p class='pLine _capitalize'><b>kategori: </b> <a href='$k[id_kategori]-kategori-$k[kategori_seo].html'> $k[nama_kategori] </a></p>
								<p class='pLine _capitalize'><b>Harga: </b> $divharga </p>
								<p class='pLine _uppercase'>
									<img src='jolibs/images/cart.png' class='Icon' />  <b><a href='{$linkBeli}' title='$b[nama_produk]'>Beli</a></b>
								</p>
							</div>";
								echo "<div class='clear' style='border-bottom: 2px dotted #ddd; height:10px; margin: 10px 0 10px 0;'></div>";
					}                                                          
				  }
				  else{
						$sql=mysql_query("SELECT nama_kategori FROM kategori_produk WHERE id_kategori='$katb'");
						$s=mysql_fetch_array($sql);
						echo "<p class='_capitalize'>Tidak ditemukan produk dengan kata <b style='color:#7A0503'> $kata</b>, pada <b style='color:#7A0503'> semua kategori</b></p>";
					}
	} else {
				$cari = "SELECT * FROM produk WHERE " ;
				for ($i=0; $i<=$jml_kata; $i++){
					$cari .= "id_kategori='$katb' AND nama_produk LIKE '%$pisah_kata[$i]%' ";
					if ($i < $jml_kata ){
						$cari .= " AND ";
					  }
				}
				  $cari .= " ORDER BY id_produk";
				  $hasil  = mysql_query($cari);
				  $ketemu = mysql_num_rows($hasil);
				
				
				echo "<h1 class='hTitle _capitalize'> hasil pencarian </h1>";
				  if ($ketemu > 0)
				  {	 
					$sql=mysql_query("SELECT nama_kategori FROM kategori_produk WHERE id_kategori='$katb'");
					$s=mysql_fetch_array($sql);
					
					echo "<p class='_capitalize'>kata kunci &raquo; <b style='color:#7A0503'> $kata </b>, kategori &raquo; <b style='color:#7A0503'> $s[nama_kategori] </b></p>";
					while($b=mysql_fetch_array($hasil))
					{
	
						//get kategori
						$kat=mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$b[id_kategori]'");
						$k=mysql_fetch_array($kat);
									
						$harga 		= format_rupiah($b['harga']);
						$divharga 	= '<font style="color: #C65159;">Rp. '.$harga.' ,-</font>';
				
						echo "<div class='divIprod _capitalize'>
								<h1><a href='produk-$b[id_produk]-$b[produk_seo].html' title='$b[nama_produk]'>$b[nama_produk]</a> </h1>
								<a href='produk-$b[id_produk]-$b[produk_seo].html' title='$b[nama_produk]'><img class='iProdPic' src='joimg/produk/$b[gambar]' width='220px' /></a>
							</div>
							<div class='divTprod'>
								<p class='pLine _capitalize'><b>kategori: </b> <a href='$k[id_kategori]-kategori-$k[kategori_seo].html'> $k[nama_kategori] </a></p>
								<p class='pLine _capitalize'><b>Harga: </b> $divharga </p>
								<p class='pLine _uppercase'>
									<img src='jolibs/images/cart.png' class='Icon' />  <b><a href='{$linkBeli}' title='$b[nama_produk]'>Beli</a></b>
								</p>
							</div>";
						echo "<div class='clear' style='border-bottom: 2px dotted #ddd; height:10px; margin: 10px 0 10px 0;'></div>";
					}                                                          
				  }
				  else{
						$sql=mysql_query("SELECT nama_kategori FROM kategori_produk WHERE id_kategori='$katb'");
						$s=mysql_fetch_array($sql);
						echo "<p class='_capitalize'>Tidak ditemukan produk dengan kata <b style='color:#7A0503'> $kata</b>, pada kategori <b style='color:#7A0503'> $s[nama_kategori]</b></p>";
					}
	}

  echo "</div>"; 
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>not found!</b></p>";
}
?>