<?php 
	
	$idkelas  = $_GET['idkelas'];
	$idjadwal = $_GET['idjadwal'];

	include '../../config/koneksi.php';

		$queryjadwal	="DELETE FROM akademik.ak_perkuliahan WHERE idkelas='$idkelas' AND idjadwal = '$idjadwal'";
		$datajadwal	= pg_query($conn, $queryjadwal);

		//echo "Data Telah Terhapus"
		echo "<br><br><br><br><strong><center><h1>Data Realisasi telah di hapus</h1>";
		
		//echo "<meta http-equiv='refresh' content='o; url=../admin/index.php?page=info'>";

?>
<script type="text/javascript">
    window.location.href='../index.php?page=kelas&idkelas=<?php echo $idkelas; ?>';
</script>

<!-- <META HTTP-EQUIV='REFRESH' CONTENT ="0; URL=../dosen/index.php?page=lpresensi&&nimnik='.$nimnik.'&&idkelas='.$idkelas.'"> -->