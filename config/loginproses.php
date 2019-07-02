<?php
	error_reporting();
	include "koneksi.php";

	$nimnik  = $_POST["nimnik"];
	$password  = $_POST['password'];

	$query     ="SELECT * FROM akademik.user WHERE nimnik='$nimnik' AND password='$password'";

	$login     = pg_query($conn,$query) or die(pg_error($conn));
	$jlhrecord = pg_num_rows($login);

	$data      = pg_fetch_array($login);

	$nimnik  = $data['nimnik'];
	$password  = $_POST['password'];
	$level	   = $data['level'];


if($jlhrecord > 0){

	session_start();
	$_SESSION['nimnik']=$nimnik;
	$_SESSION['password']=$password;
	$_SESSION['level']=$level;

	//redirect level
		if($level == Dosen){
			header('Location:../dosen/index.php?page=index&&nimnik='.$data['nimnik'].'');
		}
		elseif ($level == Mhs){
			header('Location:../mhs/index.php?page=index&&nimnik='.$data['nimnik'].'');
		}
		elseif ($level == Admin){
			header('Location:../admin/index.php');
		}
}

else{

	print "
	<script>
	alert(\"Username atau Password Anda Salah! Silahkan Login kembali\");
				history.back(-1);
			</script>";
	echo '<META HTTP-EQUIV="REFRESH" CONTENT = "2; URL=../index.php">';  
}

?>