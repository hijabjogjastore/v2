<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_shoutbox/aksi_shoutbox.php";
switch($_GET[act]){
  // Tampil Shoutbox
  default:
    echo "<h2 class='hLine'>Shoutbox</h2>
          <table class='list'>
          <thead>
			<tr>
				<td class='center'>no.</td>
				<td class='center'>nama</td>
				<td class='center'>pesan</td>
				<td class='center'>aktif</td>
				<td class='center' colspan='2'>aksi</td>
			</tr></thead>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil=mysql_query("SELECT * FROM shoutbox ORDER BY id_shoutbox DESC LIMIT $posisi,$batas");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td width='80'>$no.</td>
                <td class='left'>$r[nama]</td>
                <td class='left'>$r[pesan]</td>
                <td width=5 align=center>$r[aktif]</td>
					<td width='20'><a href=?module=shoutbox&act=editshoutbox&id=$r[id_shoutbox]><img src='images/add-icon.gif' title='Edit' /></a></td>
					<td width='20'><a href=$aksi?module=shoutbox&act=hapus&id=$r[id_shoutbox]><img src='images/hr.gif' title='Hapus'></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM shoutbox"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
    break;
  
  case "editshoutbox":
    $edit = mysql_query("SELECT * FROM shoutbox WHERE id_shoutbox='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Shoutbox</h2>
          <form method=POST action='$aksi?module=shoutbox&act=update'>
          <input type=hidden name=id value=$r[id_shoutbox]>
          <table class='list'>
          <tr>
			<td class='left'>Nama</td>
			<td class='left'>: <input type=text name='nama' size=30 value='$r[nama]'></td></tr>
          <tr>
			<td class='left'>Website</td>
			<td class='left'>: <input type=text name='website' size=30 value='$r[website]'></td></tr>
          <tr>
			<td class='left'>Pesan</td>
			<td class='left'> 
				<textarea name='pesan' class='msgBox'>$r[pesan]</textarea></td></tr>";

    if ($r['aktif']=='Y'){
      echo "<tr>
				<td class='left'>Aktif</td>
				<td class='left'>: <input type=radio name='aktif' value='Y' checked>Y  
                                   <input type=radio name='aktif' value='N'> N</td></tr>";
    }
    else{
      echo "<tr>
				<td class='left'>Aktif</td>
				<td class='left'>: <input type=radio name='aktif' value='Y'>Y  
                                   <input type=radio name='aktif' value='N' checked>N</td></tr>";
    }

    echo "<tr>
			<td  class='left' colspan=2>
				<input type='submit' value='Update' class='butt' />
                <input class='butt' type='button' value='Batal' onclick='self.history.back()' /></td></tr>
          </table></form>";
    break;  
}
}
?>
