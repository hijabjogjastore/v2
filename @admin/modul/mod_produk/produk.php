<?php
@session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_produk/aksi_produk.php";
switch(@$_GET['act']){

//Tampil Produk
    default:
    echo "<h2 class='hLine'>Produk</h2>
          <input type=button class='butt' value='Tambah Produk' onclick=\"window.location.href='?module=produk&act=tambahproduk';\">
          <table class='list' id='listTable'>
          <thead>
			  <tr>
				<th class='center'>No.</td>
				<th class='center'>Nama Produk</td>
				<th class='center'>Harga</td>
				<th class='center'>Kategori Produk</td>
				<th class='center' width='80'>Promo</td>
				<th class='center' width='100'>Terlaris</td>
				<th class='center'>Aksi </td>
				
			  </tr>
		  </thead>";

    $tampil = mysql_query("SELECT * FROM produk ORDER BY id_produk DESC");
  
    $no = 1;
    while($r=mysql_fetch_array($tampil))
    {
      $harga=format_rupiah($r['harga']);
	  
	  //get kategori 
	  $kat=mysql_query("SELECT * FROM kategori WHERE id_kategori='$r[id_kategori]'");
	  $k=mysql_fetch_array($kat);
	  
      echo "<tr><td>$no.</td>
                <td class='left  _capitalize'>$r[nama_produk]</td>
                <td class='left'>Rp. $harga</td>
                <td class='left'>$k[nama]</td>
                <td class='center'>";
					if($r['special']=='Y')
					{
						echo "<a style='color:green;' href='$aksi?module=produk&act=updatePromo&stat=$r[special]&id=$r[id_produk]' title='click untuk non-aktifkan promo'>Ya</a>";
					}
					else 
					{
						echo "<a style='color:red;' href='$aksi?module=produk&act=updatePromo&stat=$r[special]&id=$r[id_produk]' title='click untuk mengaktifkan promo'>Tidak</a>";
					}
				echo"</td>";
				
				
				
				//terlaris
				echo "<td class='center'>";
					if($r['terlaris']=='Y')
					{
						echo "<a style='color:green;' href='$aksi?module=produk&act=updateLaris&stat=$r[terlaris]&id=$r[id_produk]' title='click untuk non-aktifkan produk terlaris'>Ya</a>";
					}
					else
					{
						echo "<a style='color:red;' href='$aksi?module=produk&act=updateLaris&stat=$r[terlaris]&id=$r[id_produk]' title='click untuk mengaktifkan poduk terlaris'>Tidak</a>";
					}
				echo "</td>";
		        echo "<td>
					<p>
						<a href=?module=produk&act=editproduk&id=$r[id_produk]><img src='images/add-icon.gif' title='Edit Detail' /></a>
						&nbsp;&nbsp;
						<a href=$aksi?module=produk&act=hapus&id=$r[id_produk]><img src='images/hr.gif' title='Hapus' /></a>
						&nbsp;&nbsp;
						<a href=?module=subimages&id=$r[id_produk]><img src='images/images.png' title='images' /></a>
					</p>
					</td>
		        </tr>";
      $no++;
    }
    echo "</table>";
	//echo pagination($table,$limit,$page, $url);
    break;
  
  
//Tambah Produk Disini
    case "tambahproduk":
    echo "<h2 class='hLine'><a href='?module=produk'>Produk</a> &raquo; Tambah Produk</h2>
          <form method=POST action='$aksi?module=produk&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td width=100 class='left'>Nama Produk</td>
			<td class='left'><input class='msgBox' type=text name='nama_produk' size=60></td>
		  </tr>
          <tr>
			<td class='left'>Kategori</td>
			<td class='left'>";
			$tampil=mysql_query("SELECT * FROM kategori ORDER BY nama");
            $cek=mysql_num_rows($tampil);
				if($cek<='0'){ 
					echo "<b style='color:red;'>Belum ada Kategori Produk!</b>";
				} else {
							echo "<select name='kategori'><option value=0 selected>- Pilih Kategori -</option>";
							
							while($r=mysql_fetch_array($tampil))
							{
								echo "<option value=$r[id_kategori]>$r[nama]</option>";				
							}
							echo "</select>";
						}
	echo "</td>
		</tr>
          <tr>
			<td class='left'>Harga</td>
			<td class='left'><input class='msgBox' type='text' id='angka' name='harga' size=55 maxlength=10> * Penulisan harga tanpa tanda (.) titik</td></tr>
			
		 <tr>
			<td class='left'>Deskripsi</td>  
			<td><textarea id='jogmce' name='deskripsi' style='width: 100%; height: 350px;'></textarea></td></tr>
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
    
    case "editproduk":
    $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	
	$tanggal=tgl_indo($r['tgl_masuk']);
	
    echo "<h2 class='hLine'><a href='?module=produk'>Produk</a> &raquo; Edit $r[nama_produk]</h2>";
    echo "<table class='list'>";
     //tanggal masuk
	echo "<tr><td class='left' width='100'>Tanggal Masuk</td><td class='left'>$tanggal</td></tr></table>"; 
	
    //produk to opsi
    
    echo "<h2 class='hLine'>Detail Produk</h2>";
    echo "<form method=POST enctype='multipart/form-data' action=$aksi?module=produk&act=update>
          <input type=hidden name=id value=$r[id_produk]>
          <table class='list'>";
	//nama produk
	echo "<tr>
			<td class='left' width=120>Nama Produk</td>
			<td class='left'><input class='msgBox' size='60' type=text name='nama_produk' size=60 value='$r[nama_produk]'></td>
		  </tr>";
		  
	//kategori
    echo   "<tr>
			<td class='left'>Kategori</td>
			<td class='left'><select name='kategori'>";
 
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama");
          if ($r['id_kategori']==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   
          while($w=mysql_fetch_array($tampil)){
            if ($r['id_kategori']==$w['id_kategori']){
              echo "<option value=$w[id_kategori] selected>$w[nama]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama]</option>";
            }
          }
    echo "</select></td></tr>";
	
	//Sub Kategori
	echo   "<tr>
			<td class='left'>Sub Kategori</td>
			<td class='left'><select name='subkategori'>";
 
          $tampil=mysql_query("SELECT * FROM subkategori ORDER BY nama");
          if ($r['id_subkategorikategori']==0){
            echo "<option value=0 selected>- Pilih Sub Kategori -</option>";
          }   
          while($w=mysql_fetch_array($tampil)){
            if ($r['id_subkategori']==$w['id_subkategori']){
              echo "<option value=$w[id_subkategori] selected>$w[nama]</option>";
            }
            else{
              echo "<option value=$w[id_subkategori]>$w[nama]</option>";
            }
          }
    echo "</select></td></tr>";
		
	//harga
    echo "<tr>
			<td class='left'>Harga</td>
			<td  class='left'><input class='msgBox' id='angka' type='text' name='harga' value=$r[harga] size=50 maxlength=10/> * Penulisan harga tanpa tanda (.) titik </td>
		  </tr>
          <tr>
			<td  class='left'>Deskripsi</td>
			<td> <textarea name='deskripsi' id='jogmce' style='width: 100%px; height: 350px;'>$r[deskripsi]</textarea></td>
		  </tr>";
		 
    //gambar
	echo "<tr>
			<td  class='left'>Gambar</td>
			<td  class='left'>  
			<img src='../joimg/produk/s_$r[gambar]'></td>
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

/*
*	PRODUK PROMO
*/
	case "promo":
	//paging
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $url = "?module=$_GET[module]&act=promo&";
    $limit = 5;
    $startpoint = ($page * $limit) - $limit;     
    $table = "produk WHERE special='Y'";
	
	echo "<h2 class='hLine'><a href='?module=produk'> Produk</a> &raquo; Promo</h2>";
	echo "<table class='list'>
            <thead>
			  <tr>
				<td class='center'> No. </td>
				<td class='center'> Nama Produk </td>
				<td class='center'> Harga </td>
				<td class='center'> Kategori Produk </td>
				<td colspan='2' class='center'> Aksi </td>
			  </tr>
		    </thead>";
			
	$sql = mysql_query("SELECT * FROM produk WHERE special='Y' ORDER BY id_produk DESC LIMIT {$startpoint},{$limit}");
	$no  = $startpoint+1;
	
	while($s=mysql_fetch_array($sql))
	{
	    $harga=format_rupiah($s['harga']);
		//get kategori
		$kat=mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$s[id_kategori]'");
		$k=mysql_fetch_array($kat);
		
		echo "<tr><td class='center'>$no.</td>";
		echo "<td class='left'>$s[nama_produk]</td>";
		echo "<td class='left'>Rp. $harga,-</td>";
		echo "<td class='left'>$k[nama_kategori]</td>";
		echo "<td><a href=$aksi?module=produk&act=hapus&id=$s[id_produk]><img src='images/hr.gif' title='Hapus' /></a></td>
		</tr>";
		$no++;
	}
	echo "</table>";
	echo pagination($table, $limit, $page, $url);
	break;
	
	
/*
*	PRODUK TERLARIS
*/
	case "terlaris":
	//paging
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $url = "?module=$_GET[module]&act=terlaris&";
    $limit = 5;
    $startpoint = ($page * $limit) - $limit;     
    $table = "produk WHERE terlaris='Y'";
	
	echo "<h2 class='hLine'><a href='?module=produk'> Produk</a> &raquo; Terlaris</h2>";
	echo "<table class='list'>
            <thead>
			  <tr>
				<td class='center'> No. </td>
				<td class='center'> Nama Produk </td>
				<td class='center'> Harga </td>
				<td class='center'> Kategori Produk </td>
				<td colspan='2' class='center'> Aksi </td>
			  </tr>
		    </thead>";
			
	$sql = mysql_query("SELECT * FROM produk WHERE terlaris='Y' ORDER BY id_produk DESC LIMIT {$startpoint},{$limit}");
	$no  = $startpoint+1;
	
	while($s=mysql_fetch_array($sql))
	{
	    $harga=format_rupiah($s['harga']);
		//get kategori
		$kat=mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$s[id_kategori]'");
		$k=mysql_fetch_array($kat);
		
		echo "<tr><td class='center'>$no.</td>";
		echo "<td class='left'>$s[nama_produk]</td>";
		echo "<td class='left'>Rp. $harga,-</td>";
		echo "<td class='left'>$k[nama_kategori]</td>";
		echo "<td><a href=$aksi?module=produk&act=hapus&id=$s[id_produk]><img src='images/hr.gif' title='Hapus' /></a></td>
		</tr>";
		$no++;
	}
	echo "</table>";
	echo pagination($table, $limit, $page, $url);
	break;

	
}//end switch

}//end if else
?>
