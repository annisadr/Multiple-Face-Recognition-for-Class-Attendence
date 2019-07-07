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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Universitas Darma Persada - Presensi Kelas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.js"> --> <!-- ini di download // bs 4 css -->

  <link rel="stylesheet" href="../assets/bootstrap-4.3.1-dist/font-awesome/css/font-awesome.min.css"> <!-- icon -->

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="../assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  <!-- <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script> --> <!-- ini di download // bs 4 js-->

  <!-- gambar logout -->
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

  <!-- logo di tab -->
  <link href="../gambar/logo.png" rel="icon" type="image/x-icon" />

  <!-- css -->
  <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
  <style>
  /*.fakeimg {
    height: 200px;
    background: #aaa;
  }
  #container {
    margin: 0px auto;
    width: 500px;
    height: 375px;
    border: 10px #333 solid;
  }
  #videoElement {
    width: 500px;
    height: 375px;
    background-color: #666;
  }*/
  </style>
</head>
<body style="background-color: #f2f2f2;">

<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #003399;">
  <div class="container">
    <!-- <a class="navbar-brand" href="#">Navbar</a> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand" href="index.php?page=index&&nimnik=<?php echo $data['nimnik'];?>"><img src="../gambar/favicon.png" style="height: 40px;"></a>
        </li>

        <li class="nav-item">
          <ul style="color: white; padding-left: 5px;" type="none">
            <li style="font-size: 18px;">Sistem Informasi Akademik</li>
            <li style="font-size: 12px;"><i>Universitas Darma Persada</i></li>
          </ul>
        </li>
      </ul>
    </div>

    <p class="text-right"></p>
    <ul class="nav justify-content-end">
      <li class="nav-item">
        <a class="nav-link" style="color: white;" href="../config/logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </div>
</nav>
<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: white;">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand" href="index.php?page=index&&nimnik=<?php echo $data['nimnik'];?>" style="color: black; font-size: 14px;">Dashboard</a>
        </li>

        <!-- <li class="nav-item">
          <a class="navbar-brand" href="index.php?page=ddosen&&nimnik=<?php echo $data['nimnik'];?>" style="color: black; font-size: 14px;">Data Dosen</a>
        </li> -->
        
        <li class="nav-item">
          <a class="navbar-brand" href="index.php?page=presensi&&nimnik=<?php echo $data['nimnik'];?>" style="color: black; font-size: 14px;">Presensi</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- isi -->
<div class="container" style="padding-top: 20px;">
  <div class="row">
    <input type="hidden" name="nimnik" value="<?php echo $nimnik?>">
    <?php
      if ($page=='index')
      include ('dashboard.php');
      elseif ($page=='presensi')
      include ('presensi.php');
      elseif ($page=='dkelas')
      include ('data-kelas.php');
      elseif ($page=='ddosen')
      include ('data-dosen.php');
      elseif ($page=='sidenav')
      include ('sidenav.php');
      elseif ($page=='lpresensi')
      include ('list-presensi.php');
      elseif ($page=='facerec')
      include ('presensi-face.php');
      elseif ($page=='pkelas')
      include ('peserta-kelas.php');
      elseif ($page=='detail')
      include ('detail-pkelas.php');
      elseif ($page=='savepict')
      include ('storeImage.php');
      elseif ($page=='takephoto')
      include ('takephoto-pkelas.php');
    ?>
  </div>

</div>


</body>
</html>

<?php
}
else
  {
    header("location:../index.php");
  }
}
?>