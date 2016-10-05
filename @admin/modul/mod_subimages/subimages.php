<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else { ?>

<style type="text/css" title="currentStyle">
    @import "media/css/demo_table_jui.css";
    @import "media/css/smoothness/jquery-ui-1.8.4.custom.css";
</style>

<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js">
</script>

<script>
$(document).ready( function () {
     var oTable = $('#example').dataTable( {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
				} );		
} );
</script>
<style>.ui-widget-header{background:none;border:none;}</style>


		
		<?php
		$aksi="modul/mod_subimages/aksi_subimages.php";
		switch($_GET['act']){
			default:
		?>
		
		<article style="min-width:535px;" class="module width_3_quarter">
			<header><h3 class="tabs_involved">SubImages</h3>
				
			</header>

			<table class='display' id='example'>
			<thead> 
				<tr align="center">  
    				<th>No</th>
    				<th>Tittle</th> 
    				<th width="30%">Thumbnail</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			
			<tbody> 
			<?php 	
				$no=1;
				$slide = mysql_query("SELECT * FROM subimages WHERE product_id='$_GET[id]' ORDER BY id ASC");
					//echo $sql; exit;
				while($s=mysql_fetch_array($slide)){
				
					$pro = mysql_query("SELECT product_name FROM product where prodcut_id='$s[product_id]'");
					$tpro=mysql_fetch_array($pro);
				
				?>
				<tr>  
    				<th><?php echo"$no" ?></th>
    				<td><?php echo"$s[judul]" ?></td> 
    				<td width="30%"><img height="120px" src="../assets/images/subimages/<?php echo"$s[gambar]" ?>"></td> 
    				<td style="text-align:center"><a href="<?php echo"$aksi?module=subimages&act=hapus&id=$s[id]";?>" onclick="return confirm('Apakah anda yakin menghapus data ini?');">
					<input type="image" src="images/hr.gif" title="Trash"></a></td> 
				</tr> 
			<?php $no++; } ?>

			</tbody> 
			</table>
			<div class="clear"></div>
			<div class="clear"></div>
		</article>
		
		<article style="min-width:260px;" class="module width_quarter">
			 <header><h3>Post New Subimages</h3></header>
			 <form method='POST' enctype='multipart/form-data' action='modul/mod_subimages/aksi_subimages.php?module=subimages&act=insertnew'>
				<div class="module_content">
						<fieldset>
							<label>Title</label>
							<input name="judul" type="text">
						</fieldset>
						<input type="hidden" name="product_id" value="<?php echo"$_GET[id]"; ?>" />
						
						<fieldset style="float:left; width:30%; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Thumbnail</label><br /><br />
							<input style="margin-left:10px; margin-right:-20px;" type="file" name="fupload[]" multiple="true">
							<br /> &nbsp;&nbsp;&nbsp;&nbsp;*) Important image size 800x504 px.
						</fieldset>
						<style>fieldset input[type=text]{width:87%} fieldset textarea {width:85%}</style>
						<div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Publish" class="alt_btn">
				</div>
			</footer>
			</form>
		</article><!-- end of post new article -->
		
		
		<?php break; 
		case"edit":
			$slideshow = mysql_query("SELECT * FROM subimages WHERE id='$_GET[id]'");
				$g=mysql_fetch_array($slideshow);
		
		?>
		
		<article class="module width_quarter">
			 <header><h3 class="tabs_involved">Edit Subimages</h3>
				
				<input style="float:right; margin-top:5px;margin-right:10px;" type='button'  class='tombol' value='Back' onclick='self.history.back()'>
				
			</header>
			 <form method='POST' enctype='multipart/form-data' action='modul/mod_subimages/aksi_subimages.php?module=subimages&act=update'>
				<input type='hidden' name='id' value='<?php echo"$g[id]" ?>'>
				<div class="module_content">
						<fieldset>
							<label>Title</label>
							<input name="judul" type="text" value="<?php echo"$g[judul]" ?>">
						</fieldset>
						<fieldset>
							<label>Product Name</label>
							<select name="id_produk">
						<?php
						$pro = mysql_query("SELECT product_id,product_name FROM product order by product_id DESC");
						while($tpro=mysql_fetch_array($pro)){
							if($tpro['product_id']==$g['product_id']){
						?>
							<option value="<?php echo $tpro['product_id'];?>" selected><?php echo $tpro['product_name'];?></option>
						<?php
						}else{
						?>
							<option value="<?php echo $tpro['prodcut_id'];?>"><?php echo $tpro['product_name'];?></option>
						<?php
						}
						}
						?>
							</select>
						</fieldset>
						
						
						<fieldset style="float:left; width:30%; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Thumbnail</label><br /><br />
							<img width="200px" style="margin-left:5px;" src="../assets/images/subimages/<?php echo"$g[gambar]" ?>">
							
						</fieldset>
							
						<fieldset style="float:left; width:30%; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Change Thumbnail</label><br /><br />
							<input style="margin-left:10px; margin-right:-20px;" type="file" name="fupload">
							<br /> &nbsp;&nbsp;&nbsp;&nbsp;*) Image size 800x504 px.
						</fieldset>
						<style>fieldset input[type=text]{width:87%} fieldset textarea {width:85%}</style>
						<div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Update" class="alt_btn">
				</div>
			</footer>
			</form>
		</article><!-- end of post new article -->
		<br />
		
		<?php
		
		break; 
		 } ?>
		
<?php } ?>