<?php
session_start();

$image = $_POST['result'];

list($type, $data) = explode(';', $image);
list(, $type) = explode('/', $type);
list(, $data)      = explode(',', $data);

$image = trim( str_replace('data:image/'.$type.';base64,', "", $image ));
$image = str_replace( ' ', '+', $image );


$date = date('ymdhis');
$storeFolder = "uploadtmp";
$file_name = $date.'.'.$type;
$dir = $storeFolder;

$filestore = base64_decode($image);
// $file = fopen($dir.'/'.$file_name);
file_put_contents($dir.'/'.$file_name, $filestore);

$data = array('data'=> $dir.'/'.$file_name);
echo json_encode($data);
?>