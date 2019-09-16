

<?php

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
  <!-- <script type="text/javascript" src="../assets/jquery-3.2.1.min.js"></script> -->

  <!-- Google icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Data Table -->
  <!-- <link rel="stylesheet" href="../assets/dataTables/datatables.min.css"> -->
  
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.js"> --> <!-- ini di download // bs 4 css -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- icon -->

  <!-- jQuery library -->
  <script src="../assets/jquery-3.4.1.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->

  <!-- Popper JS -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->

  <!-- Latest compiled JavaScript -->
  <script src="../assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
  <!-- <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script> --> <!-- ini di download // bs 4 js-->

  <!-- gambar logout -->
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

  <!-- logo di tab -->
  <link href="../gambar/logo.png" rel="icon" type="image/x-icon" />

  <!-- css -->
  <link rel="stylesheet" type="text/css" href="../css/main.css">

  <!-- <script type="text/javascript" src="../assets/dataTables/jQuery-3.3.1/jquery-3.3.1.js"></script> -->
  <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
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
          <a class="navbar-brand" href="#"><img src="../gambar/favicon.png" style="height: 40px;"></a>
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
    <!-- <a class="navbar-brand" href="#">Navbar</a> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand" href="index.php?page=index" style="color: black; font-size: 14px;">Dashboard</a>
        </li>

        <li class="nav-item">
          <a class="navbar-brand" href="index.php?page=matkul" style="color: black; font-size: 14px;">Jadwal Kuliah</a>
        </li>

        <li class="nav-item">
          <a class="navbar-brand" href="index.php?page=list-mhs" style="color: black; font-size: 14px;">Mahasiswa</a>
        </li>

        <li class="nav-item">
          <a class="navbar-brand" href="index.php?page=rfoto" style="color: black; font-size: 14px;">Riwayat Foto</a>
        </li>

        <!-- <li class="nav-item">
          <a class="navbar-brand" href="index.php?page=muser" style="color: black; font-size: 14px;">Manajemen User</a>
        </li> -->
      </ul>
    </div>
  </div>
</nav>



<!-- isi -->
<div class="container" style="padding-bottom: 50px; padding-top: 20px;">
  <div class="row">
    <input type="hidden" name="id_user" value="<?php echo $id_user?>">
    <?php
      if ($page=='index')
      include ('dashboard.php');
      elseif ($page=='matkul')
      include ('matkul.php');
      elseif ($page=='muser')
      include ('manajemen-user.php');
      elseif ($page=='list-mhs')
      include ('list-mahasiswa.php');
      elseif ($page=='takephoto')
      include ('takephoto-pkelas.php');
      elseif ($page=='tkelas')
      include ('tambah-kelas.php');
      elseif ($page=='kelas')
      include ('jadwal-kelas.php');
      elseif ($page=='rfoto')
      include ('riwayat-foto.php');
      elseif ($page=='tjadwal')
      include ('tambah-jadwal.php');
    ?>
  </div>

</div>

<!-- <script src="../assets/dataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
<script src="../assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script src="../assets/dataTables/datatables.min.js"></script> -->
<script type="text/javascript" src="../assets/dataTables/jQuery-3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
  } );
</script>

</body>
</html>

<?php
}
?>