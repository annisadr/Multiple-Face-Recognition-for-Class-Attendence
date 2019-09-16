<?php 
	
	$idkelas  = $_GET['idkelas'];
	

	include '../../config/koneksi.php';

		$querykelas	="DELETE FROM akademik.ak_kelas WHERE idkelas='$idkelas'";
		$datakelas	= pg_query($conn, $querykelas);

		//echo "Data Telah Terhapus"
		echo "<br><br><br><br><strong><center><h1>Data Kelas telah di hapus</h1>";
		
		//echo "<meta http-equiv='refresh' content='o; url=../admin/index.php?page=info'>";

?>
<script type="text/javascript">
    window.location.href='../index.php?page=matkul';
</script>

<!-- <META HTTP-EQUIV='REFRESH' CONTENT ="0; URL=../dosen/index.php?page=lpresensi&&nimnik='.$nimnik.'&&idkelas='.$idkelas.'"> -->