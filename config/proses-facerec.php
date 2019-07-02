<?php
 
 include "koneksi.php";
 $raw = $_POST['imgBase64'];
 $imagePath = "../upload/"
 $filtered = explode(';base64',$raw);
 $unencoded = base64_decode($filtered[1]);

 // $foto		=	$_POST['canvas'];
 $no_urut	=	0;
 $no_urut++;

 $input="INSERT INTO akademik.foto(idfoto,namafoto) values('','$unencoded')"; #$foto-$no_urut.jpg
 $data=pg_exec($conn,$input);

 if($data){
  echo "<br><br><br><h1><strong><center><i>Data User Sudah ditambahkan</i></h1>";
  echo '<META HTTP-EQUIV="REFRESH" CONTENT = "1; URL=../admin/index.php?page=muser">'; 
 }

?>
