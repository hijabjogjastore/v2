
<?php
	include('../josys/koneksi.php');
	function anti_injection($data){
	  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	  return $filter;
	}
				$email = anti_injection($_POST['email']);

				mysql_query("INSERT INTO subcribe(email) 
										 VALUES('$_POST[email]')");
			
		echo"<script>window.alert('Thanks for your subcribe!'); window.location = 'index.php'; </script>";
		 ?>				
	