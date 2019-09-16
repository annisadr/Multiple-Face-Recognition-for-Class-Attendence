<?php
  //menyambungkan koneksi
include '../config/koneksi.php';

$nimnik = $_GET['nimnik'];
$sql    = "SELECT * FROM akademik.user WHERE nimnik = '$nimnik'";
$hasil  = pg_query($sql);
while($data=pg_fetch_array($hasil))
{
  session_start();
  if(isset($_SESSION['nimnik']))
  {
      
      if(isset($_GET['page'])) $page = $_GET['page'];
        else $page = 'index';
        include "section.php";
 }else {
    header("location:../index.php");

 }   
}

?>