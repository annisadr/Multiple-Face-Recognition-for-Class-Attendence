<?php
 
 include "koneksi.php";

 
 $idkelas 		=	$_GET['idkelas'];
 $idjadwal		=	$_GET['idjadwal'];
 $idruang		=	$_GET['idruang'];
 $tgljadwal		=	$_GET['tgljadwal'];
 $waktumulai	=	$_GET['waktumulai'];
 $waktuselesai	=	$_GET['waktuselesai'];
 $nik			=	$_GET['nimnik'];
 

 $inputjadwal="INSERT INTO akademik.ak_perkuliahan(idjadwal,idruang,idkelas,tgljadwal,waktumulai,waktuselesai) values('$idjadwal','$idruang','$idkelas','$tgljadwal','$waktumulai','$waktuselesai')";
 $datajadwal=pg_query($conn,$inputjadwal) or die (pg_error($konek));


 if($datajadwal){
  echo "<h5><i><strong><center>Data Kelas Sudah ditambahkan</strong></i></h5>";
  echo '<META HTTP-EQUIV="REFRESH" CONTENT = "1; URL=../dosen/index.php?page=lpresensi&&nimnik='.$nik.'&&idkelas='.$idkelas.'">'; 
 }

?>