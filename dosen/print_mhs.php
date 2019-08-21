<!DOCTYPE html>
<html>
<head>
  <title>Universitas Darma Persada - Laporan Hasil Presensi Mahasiswa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.js"> --> <!-- ini di download // bs 4 css -->

  <!-- icon -->
  <link rel="stylesheet" href="../assets/bootstrap-4.3.1-dist/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

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
</head>

<!-- onload="window.print()" -->
<body onload="window.print()" style="font-family: Times New Roman, Times, serif;">
  <div align="center">
    <div style="width: 800px;">
      <table width="100%">
        <tbody>
          <tr class="noborder" align="center">
            <td rowspan="4" style="text-align:center">
              <img src="http://portal.unsada.ac.id/siakad/img/header/logo.png" height="110">
            </td>
            <td>
              <h2 style="font-family: 'Times New Roman', Times, serif;font-size: 24px;font-weight: bold;">UNIVERSITAS DARMA PERSADA</h2>
            </td>
          </tr>
          <tr class="noborder" align="center">
            <td colspan="2">
                Jalan Taman Malaka Selatan - Pondok Kelapa - Jakarta Timur - 13450
            </td>
          </tr>
          <tr class="noborder" align="center">
            <td colspan="2">
                Telp 8649051, 8649053, 8649057 Fax. 8649052
            </td>
          </tr>
          <tr class="noborder" align="center">
            <td colspan="2">
              Email : humas@unsada.ac.id Homepage : http//:www.unsada.ac.id
            </td>
          </tr>
          <tr class="noborder" align="center">
            <td colspan="4"><hr style="border-bottom:double"></td>
          </tr>
        </tbody>
      </table>

      <font size="4" style="font-weight: bold;">LAPORAN DAFTAR PRESENSI MAHASISWA</font><br>
      Program Studi : TEKNIK INFORMATIKA<br>
      Tahun Akademik : 2018/2019 GENAP<br><br><br>
      <?php
        include "../config/koneksi.php";
        $idkelas= htmlspecialchars($_GET["idkelas"]);
        $nimnik= htmlspecialchars($_GET["nimnik"]);

        // echo $nimnik;
        $sqlatas  = pg_query("SELECT * FROM akademik.ak_matakuliah LEFT JOIN akademik.ak_kelas ON ak_matakuliah.idmk=ak_kelas.idmk LEFT JOIN akademik.ak_perkuliahan ON ak_kelas.idkelas=ak_perkuliahan.idkelas WHERE ak_perkuliahan.idkelas='$idkelas'");
        $dataatas = pg_fetch_array($sqlatas);
      ?>
      <table width="100%" style="font-weight: bold;">
        <tbody>
          <tr valign="top">
            <td width="120">Mata kuliah</td>
            <td width="10" align="center">:</td>
            <td colspan="4"><?php echo $dataatas['idmk'];?> / <?php echo $dataatas['namamk'];?> / <?php echo $dataatas['sksmk'];?></td>
            <td width="100">Nama Kelas</td>
            <td width="10" align="center">:</td>
            <td><?php echo $dataatas['namakelas'];?></td>
          </tr>
       
          <tr valign="top">
            <td width="120">Waktu</td>
            <td width="10" align="center">:</td>
            <td colspan="4"><?php echo $dataatas['waktumulai'];?> - <?php echo $dataatas['waktuselesai'];?></td>
            <td width="100">Ruang Kelas</td>
            <td width="10" align="center">:</td>
            <td><?php echo $dataatas['idruang'];?></td>
          </tr>
        </tbody>
      </table>

      <table class="table table-bordered table-sm table-stripped">
        <thead class="thead-dark">
          <tr align="center" style="font-size: 15px;">
            <th rowspan="2">No</th>
            <th rowspan="2">NIM</th>
            <th colspan="5">Pertemuan ke-</th>
          </tr>
          <tr align="center" style="font-size: 15px;">
            <?php
              include "../config/koneksi.php";
              $no_urut = 0;
              $idkelas= htmlspecialchars($_GET["idkelas"]);

              $sqljmlpert = pg_query("SELECT * FROM akademik.ak_perkuliahan WHERE idkelas='$idkelas'");
              while($datajmlpert=pg_fetch_array($sqljmlpert)){
                $no_urut++;
            ?>
              <?php echo '<th><font size="2px">'.$no_urut.'</font></th>';?>
            <?php
              }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
            include "../config/koneksi.php";
            // $no_urut = 0;
            
            // $idkls=$_GET['idkelas'];
            $idkelas= htmlspecialchars($_GET["idkelas"]);
            $nimnik= htmlspecialchars($_GET["nimnik"]);
            // var_dump($idkelas);
            // var_dump($nimnik);

            $sql1    = "SELECT DISTINCT * FROM akademik.ak_krs LEFT JOIN akademik.ak_kelas ON ak_krs.idkelas = ak_kelas.idkelas WHERE ak_kelas.idkelas='$idkelas'";
            // var_dump($sql1); die();
            $hasil1   = pg_query($sql1);

            if(pg_num_rows($hasil1) == 0){
              echo '<tr><td colspan="7" align="center">Tidak Ada Mahasiswa Terdaftar untuk Kelas ini</td></tr>';
            }
            else{

            $nomor = 0;
            while($data1=pg_fetch_array($hasil1))
            {  
                $nomor++;
                // $sql1 = "SELECT * FROM public.user";
                // $data1 = pg_exec($sql1);
                echo '<tr align="center">';
                  echo '<td><font size="2px">'.$nomor.'</font></td>';
                  
                  echo '<td><font size="2px">'.$data1['nim'].'</font></td>';
                  
                ?>
                <!-- disini hasil hadir & alfa -->
                <?php
                  include "../config/koneksi.php";
                  $no_urut = 0;
                  $idkelas= htmlspecialchars($_GET["idkelas"]);

                  $sqljmlpert = pg_query("SELECT * FROM akademik.ak_perkuliahan WHERE idkelas='$idkelas'");
                  while($datajmlpert=pg_fetch_array($sqljmlpert)){
                    $no_urut++;
                ?>
                  <!-- <?php echo '<th><font size="2px">'.$no_urut.'</font></th>';?> -->
                  <td>
                  <?php 
                    $nim = $data1['nim'];
                    $idjadwal = $datajmlpert['idjadwal'];
                    $sqlhadir = pg_query("SELECT * FROM akademik.ak_absensimhs LEFT JOIN akademik.ak_krs ON ak_absensimhs.nim=ak_krs.nim WHERE ak_absensimhs.nim = '$nim' AND ak_absensimhs.idjadwal = '$idjadwal'");
                    // $sqlhadir = pg_query("SELECT * FROM akademik.ak_absensimhs");
                    $datahadir = pg_fetch_array($sqlhadir);
                    if($datahadir['nim']==$nim){
                      echo $datahadir['statushadir'];
                    }
                    else {
                      echo 'A';
                    }
                  ?>
                </td>
                <?php
                  }
                ?>
                  <!-- echo '<td><font size="2px"></font></td>'; -->
                <?php
                  
                echo '</tr>';
                
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>