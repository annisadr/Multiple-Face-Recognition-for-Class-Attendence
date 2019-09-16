<?php


include "../config/koneksi.php";

$nim = $_POST['nim'];
$idjd = $_POST['idjadwal'];
// $idkls = $_POST['idkelas'];

if($nim == '' || empty($nim)) {
	$result = ['result' => 2 , 'data' => "Failed NiM"];	
	echo json_encode($result); die();
}


$querycek = "SELECT * FROM akademik.ak_absensimhs WHERE nim='".$nim."' AND idjadwal='".$idjd."'";


$hasil = pg_query($querycek);
$res = pg_fetch_object($hasil);

if ($res) {
	$result = ['result' => 1 , 'data' => "Success"];
} else {
	$result = ['result' => 0 , 'data' => "Failed"];
}






// $cekkelas = "SELECT * FROM akademik.ak_krs WHERE nim='".$nim."' AND idkelas='".$idkls."'";


// $hasilkelas = pg_query($cekkelas);
// $res1 = pg_fetch_object($hasilkelas);
// if ($res) {
// 	$result = ['result' => 2 , 'data' => "Valid"];
// } else {
// 	$result = ['result' => 0 , 'data' => "Invalid"];
// }

echo json_encode($result);

?>