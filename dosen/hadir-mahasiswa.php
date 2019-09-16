<div class="container">
	<table width="100%" style="font-weight: bold;">
        <tbody>
          
        </tbody>
      </table>

      <table class="table table-bordered table-sm table-stripped">
        <thead class="thead-dark">
          <tr align="center" style="font-size: 15px;">
            <th rowspan="2">No</th>
            <th rowspan="2">NIM</th>
            <th colspan="14">Pertemuan ke-</th>
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
            $nim= htmlspecialchars($_GET["nim"]);
            // var_dump($idkelas);
            // var_dump($nimnik);

            $sql1    = "SELECT DISTINCT * FROM akademik.ak_krs LEFT JOIN akademik.ak_kelas ON ak_krs.idkelas = ak_kelas.idkelas WHERE ak_kelas.idkelas='$idkelas' AND nim='$nim'";
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