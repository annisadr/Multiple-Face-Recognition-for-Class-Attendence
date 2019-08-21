<?php
 
 include "../../config/koneksi.php";

 
 $idkelas 		=	$_GET['idkelas'];
 $idmk			=	$_GET['idmk'];
 $namakelas		=	$_GET['namakelas'];
 $idjadwal		=	$_GET['idjadwal'];
 $idruang		=	$_GET['idruang'];
 $tgljadwal		=	$_GET['tgljadwal'];
 $waktumulai	=	$_GET['waktumulai'];
 $waktuselesai	=	$_GET['waktuselesai'];
 
 

 $inputkelas="INSERT INTO akademik.ak_kelas(idkelas,idmk,namakelas) values('$idkelas','$idmk','$namakelas')";
 $datakelas=pg_query($conn,$inputkelas) or die (pg_error($conn));

 $inputjadwal="INSERT INTO akademik.ak_perkuliahan(idjadwal,idruang,idkelas,tgljadwal,waktumulai,waktuselesai) values('$idjadwal','$idruang','$idkelas','$tgljadwal','$waktumulai','$waktuselesai')";
 $datajadwal=pg_query($conn,$inputjadwal) or die (pg_error($konek));

 $datadosen=pg_query($conn,"INSERT INTO akademik.dosen(nik,idkelas) VALUES('$nik','$idkelas')");

// tanda & nya masih error tapi bisa input
 if($datakelas&$datajadwal&$datadosen){
  echo "<h5><i><strong><center>Data Kelas Sudah ditambahkan</strong></i></h5>";
  echo '<META HTTP-EQUIV="REFRESH" CONTENT = "1; URL=../admin/index.php?page=matkul">'; 
 }

?>