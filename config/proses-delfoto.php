<?php
error_reporting();
$path = '../dosen/uploadtmp/';
if ($handle = opendir($path)) {

    while (false !== ($file = readdir($handle))) { 
        $filelastmodified = filemtime($path . $file);
        //24 hours in a day * 3600 seconds per hour
        if((time() - $filelastmodified) > 7*24*3600)
        {
           unlink($path . $file);
        }

    }

    closedir($handle); 
}
?>

<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../admin/index.php?page=rfoto'>