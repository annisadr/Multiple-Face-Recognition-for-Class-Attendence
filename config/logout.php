<?php

session_start();
$out=session_destroy();
if($out)
{
	echo "<br><br><br><strong><center><h3><i>Anda Sudah Keluar Dari Halaman</i></h3>";

}
?>

<META HTTP-EQUIV="REFRESH" CONTENT = '1;url=../index.php'>

<!--  <?php session_start();
	session_destroy();
			?>	
	<script type="text/javascript">
		alert("Anda Berhasil keluar");
	</script>
	<script>
		window.location='../index.php';
	</script>
	<?
	//header("Location:index.php");
?> -->