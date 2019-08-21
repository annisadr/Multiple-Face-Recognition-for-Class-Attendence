<?php 
	$nimnik   = $_GET['nimnik'];
	$idkelas  = $_GET['idkelas'];
	$idjadwal = $_GET['idjadwal'];

	include 'koneksi.php';

		$queryjadwal	="DELETE FROM akademik.ak_perkuliahan WHERE idkelas='$idkelas' AND idjadwal = '$idjadwal'";
		$datajadwal	= pg_query($conn, $queryjadwal);

		$queryabsen	="DELETE FROM akademik.ak_absensimhs WHERE idjadwal = '$idjadwal'";
		$dataabsen	= pg_query($conn, $queryabsen);

		//echo "Data Telah Terhapus"
		echo "<br><br><br><br><strong><center><h1>Data Realisasi telah di hapus</h1>";
		
		//echo "<meta http-equiv='refresh' content='o; url=../admin/index.php?page=info'>";

?>
<script type="text/javascript">
    window.location.href='../dosen/index.php?page=lpresensi&&nimnik=<?php echo $nimnik; ?>&idkelas=<?php echo $idkelas; ?>';
</script>

<!-- <META HTTP-EQUIV='REFRESH' CONTENT ="0; URL=../dosen/index.php?page=lpresensi&&nimnik='.$nimnik.'&&idkelas='.$idkelas.'"> -->