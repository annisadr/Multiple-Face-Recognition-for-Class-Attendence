<?php
$raw = $_POST['imgBase64'];
$filtered = explode(',',$raw);
$unencoded = base64_decode($filtered[1]);
$randomname = rand(0, 99);
$fp = fopen($randomname.'.jpg', 'w');
fwrite($fp, $unencoded);
fclose($fp);
?>