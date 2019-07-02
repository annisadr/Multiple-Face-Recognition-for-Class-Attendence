<?php
 
 include "koneksi.php";


 $nama			 	=	$_POST['nama'];
 $nimnik 			=	$_POST['nimnik'];
 $password 			=	$_POST['password'];
 $level 			=	$_POST['level'];
 


 $input="INSERT INTO public.user(nama,nimnik,password,level) values('$nama','$nimnik','$password','$level')";
 $data=pg_exec($conn,$input);

 if($data){
  echo "<br><br><br><h1><strong><center><i>Data User Sudah ditambahkan</i></h1>";
  echo '<META HTTP-EQUIV="REFRESH" CONTENT = "1; URL=../admin/index.php?page=muser">'; 
 }

?>