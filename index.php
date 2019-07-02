<!-- tidak bisa 2 login -->
<?php
  //menyambungkan koneksi
  include 'config/koneksi.php';

 session_start();
  if(isset($_SESSION['nimnik']) ){
    header("Location: halo.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sistem Informasi Akademik Universitas Darma Persada Jakarta</title>
  <!-- <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <!-- logo di tab -->
  <link href="gambar/logo.png" rel="icon" type="image/x-icon" />

  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
  <div class="login">
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand" href="#"><img src="gambar/favicon.png" style="height: 40px;"></a>
        </li>

        <li class="nav-item">
          <ul style="color: white; padding-left: 5px;" type="none">
            <li style="font-size: 18px;">Sistem Informasi Akademik</li>
            <li style="font-size: 12px;"><i>Universitas Darma Persada</i></li>
          </ul>
        </li>
      </ul>
    </div>
    <br><br>
    <h1 class="login-heading">
      Please login.</h1>
      <form action="config/loginproses.php" method="POST" role="form">
        <input type="text" name="nimnik" placeholder="Akun Pengguna" required="required" class="input-txt" />
          <input type="password" name="password" placeholder="Password" required="required" class="input-txt" />
          <div class="login-footer">
             
            <button type="submit" role="button" name="login" class="btn btn--right" value="Login">Sign in  </button>
    
          </div>
      </form>
  </div>
</div>
  
  

    <script src="js/index.js"></script>



</body>
</html>
