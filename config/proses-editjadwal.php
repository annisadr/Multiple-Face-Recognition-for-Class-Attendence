<?php
	include 'koneksi.php';
	
	
    $nimnik   = $_POST['nim'];

    // die(var_dump($nimnik));
    $idruang  = $_POST['idruang'];
    $idkelas  = $_POST['idkelas'];
    $idjadwal   = $_POST['idjadwal'];
	$tgljadwal	= $_POST['tgljadwal'];
	$waktumulai	= $_POST['waktumulai'];
    $waktuselesai = $_POST['waktuselesai'];
    // $tgljadwal  =date('Y-m-d');

    // var_dump($nimnik); die();

	$update 	= "UPDATE akademik.ak_perkuliahan SET idruang='$idruang', tgljadwal='$tgljadwal', waktumulai='$waktumulai', waktuselesai='$waktuselesai' WHERE idjadwal='$idjadwal'";
	$updatejadwal	= pg_query($conn, $update);

    // die(var_dump($update));
// if ($updatejadwal)
//     {
//     	echo "<strong><center>Data Berhasil Diubah";
//     	echo '<META HTTP-EQUIV="REFRESH" CONTENT = "1; URL="../dosen/index.php?page=lpresensi&&nimnik='.$nimnik.'&&idkelas='.$idkelas.'">';
//     }
// else {
//     	//echo "<strong><center>Data Gagal Diubah";
//     	//echo '<META HTTP-EQUIV="REFRESH" CONTENT = "1; URL=../index.php?halaman=edit_info">';
//     	print"
//     		<script>
//     			alert(\"Data Gagal Diubah!\");
//     			history.back(-1);
//     		</script>";
//     }
    // echo "<br><br><br><br><strong><center><h1>Data Perkuliahan Berhasil di Ubah</h1>";


?>
<script type="text/javascript">
    window.location.href='../dosen/index.php?page=lpresensi&&nimnik=<?php echo $nimnik; ?>&idkelas=<?php echo $idkelas; ?>';
</script>
<!-- <META HTTP-EQUIV='REFRESH' CONTENT ="0; URL=../dosen/index.php?page=lpresensi?nimnik=<?php echo $nimnik; ?>&&idkelas=<?php echo $idkelas; ?>"> -->