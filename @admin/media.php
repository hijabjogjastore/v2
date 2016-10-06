<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>
 <center>Anda harus login dulu <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
include "../josys/koneksi.php";
include "../josys/library.php";
include "../josys/fungsi_indotgl.php";
include "../josys/fungsi_combobox.php";
include "../josys/fungsi_autolink.php";
include "../josys/fungsi_rupiah.php";
include "../josys/class_paging.php";
include "../josys/paging.php";
include "../josys/watermark.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administrator</title>
<link rel="stylesheet" href="css/reset.css" type="text/css"/>
<link rel="stylesheet" href="css/screen.css" type="text/css"/>
	<link href="css/pagination.css" rel="stylesheet" type="text/css" />
	<link href="css/grey.css" rel="stylesheet" type="text/css" />
	<link href="../jolibs/css/datatables.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="css/ie7.css" />
<![endif]	
<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="../jolibs/js/jquery.js"></script>
<script type="text/javascript" src="../jolibs/js/datatables.js"></script>
<script src="../tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
<script src="../tinymcpuk/jscripts/tiny_mce/jogmce.js" type="text/javascript"></script>
<script src="../tinymcpuk/jscripts/tiny_mce/jogmce2.js" type="text/javascript"></script>
<script src="../tinymcpuk/jscripts/tiny_mce/jogmce3.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style type="text/css">
<!--
a:link {
	color: #666666;
}
a:hover {
	color: #666666;
}
-->
</style>
<link rel="shortcut icon" href="../logo.png" />
<script>
	$(document).ready(function() {
    $('#listTable').dataTable( {
        "sPaginationType": "full_numbers"
    } );
} );
</script>

<!--Validasi Angka-->
<script src="css/jquery.min.js"></script>
	<script>
	$(document).ready(function() {
	    $('#angka').keyup(function () {  
	      // setiap karakter yang diketik akan langsung dihapus   
	      this.value = this.value.replace(/[^0-9\.]/g,'');
	    });
	});
	</script>
<!--End Validasi Angka-->

<!--Kategori-->
<script type="text/javascript">
$(document).ready(function(){ 
    $("select#kategori").change(function(){ 
        var post_string = "id_kategori=" + $(this).val();  
        $.ajax({ 
            type: "POST", 
            data: post_string, 
            dataType: "json", 
            cache: false, 
            url: 'modul/mod_produk/json.php', 
            timeout: 2000, 
            error: function() { 
                alert("Failed to submit"); 
            }, 
            success: function(data) {  
                // Bersihkan isi option id=subkategori
                $("select#subkategori option").remove(); 
 
                // Mengisikan data option id=subkategori
                $.each(data, function(i, j){ 
                    var row = "<option value=\"" + j.id_subkategori + "\">" + j.nama + "</option>"; 
                    $(row).appendTo("select#subkategori"); 
                }); 
            } 
        }); 
    });     
});
</script>
<!--End Kategori-->



</head>
<body>
<div class="sidebar">
<div class="logo clear">
				<span class="title" align="center"><img src="../assets/images/logo.png" style="width: 156px;" alt=""></span>
				<span class="text" align="center"></span>		
</div>
	<div class="menu _uppercase">
         <ul>
            <li><a href="?module=home">MENU UTAMA</a>
                <ul>
                  <?php include "menu.php"; ?>
                </ul>
            </li>
            <li><a href='#'>MENU ORDER</a>
				<ul>
					<?php
				
						echo "<li><a href='?module=order'><b>Order</b></a></li>";
						echo "<li><a href='?module=konfirmasi'><b>Konfirmasi</b></a></li>";
						/*echo "<li><a href='?module=page&act=edit&id=2'><b>Tentang Kami</b></a></li>";
						echo "<li><a href='?module=page&act=edit&id=3'><b>Dropshipping</b></a></li>";
						echo "<li><a href='?module=page&act=edit&id=4'><b>Syarat Reseller</b></a></li>";
						echo "<li><a href='?module=page&act=edit&id=5'><b>Kontak</b></a></li>";*/
					?>
				</ul>
			</li>
			<li><a href='#'>PAGE</a>
				<ul>
					<?php
						//page
						$sql=mysql_query("SELECT * FROM mod_page WHERE statis='Y'");
						while($s=mysql_fetch_array($sql)){
							echo "<li><a href='?module=page&act=edit&id=$s[id_page]'><b>$s[judul]</b></a></li>";
						}
						echo "<li><a href='?module=bank'><b>Bank</b></a></li>";
					/*	echo "<li><a href='?module=slider'><b>Slider</b></a></li>";*/
						/*echo "<li><a href='?module=page&act=edit&id=2'><b>Tentang Kami</b></a></li>";
						echo "<li><a href='?module=page&act=edit&id=3'><b>Dropshipping</b></a></li>";
						echo "<li><a href='?module=page&act=edit&id=4'><b>Syarat Reseller</b></a></li>";
						echo "<li><a href='?module=page&act=edit&id=5'><b>Kontak</b></a></li>";*/
					?>
				</ul>
			</li>
			<!-- <li>
				<a href="#">Modul Web</a>
				<ul>
					<?php //include "menu2.php"; ?>
				</ul>
			</li> -->
          </ul>
    </div>
</div>
	
	<div class="main"> <!-- *** mainpage layout *** -->
		<div class="main-wrap">
			<div class="header clear">
				<ul class="links clear">
				<li><strong>Selamat Datang <?php echo $_SESSION['namalengkap']; ?></strong>&nbsp;:&nbsp;</li>
				<li><a href="../" target="_blank">View Website</a></li>
				<li><a href="logout.php"><img src="images/out.gif" alt="" class="icon" /> <span class="text">Logout</span></a></li>
				</ul>
			</div>
			
			<div class="page clear">			
				<!-- CONTENT BOXES -->			
				<div class="content-box">
								<div style='padding:10px;'>
								<?php include "content.php"; ?>
								<div class='_clear'></div>
								</div>
				</div> <!-- end of content-box -->

				<div class="clear">
					<!-- end of content-box -->
				</div><!-- end of page -->
				
				<div class="footer clear">
					<span class="copy"><strong>
					© Copyrights 2014 <a href="http://hijabjogjastore.com">HijabJogjaStore.com</a> |
					Developed By <a href="http://ruangprogrammer.com" target="_blank">RuangProgrammer.com</a></span></strong>
				</div>
			</div>
		</div>
	</div>


</body>
</html>
<?php
}
?>
