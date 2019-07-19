<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Presensi Kelas</large></h5><br>
  </div>
  <?php
    $idkelas = $_GET['idkelas'];
    $sql4 = "SELECT * FROM akademik.ak_kelas WHERE ak_kelas.idkelas='$idkelas'";
    $hasil4 = pg_query($sql4);
    $data4 = pg_fetch_array($hasil4);
  ?>
  <div class="sidenav">
    <a href="index.php?page=pkelas&&nimnik=<?php echo $data['nimnik'];?>&&idkelas=<?php echo $data4['idkelas'];?>">Peserta Kelas</a>
    <a href="#" style="color: blue;">Presensi Kelas</a>  
  </div>
</div>

<div class="main">
  <?php
    $idkelas = $_GET['idkelas'];

    $sql2    = "SELECT * FROM akademik.ak_kelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk WHERE ak_kelas.idkelas='$idkelas'";
    $hasil2   = pg_query($sql2);
    $data2    = pg_fetch_array($hasil2);
  ?>
  
  <form style="padding-top: 20px;">
    <h5 class="sidenav-up">
      <div>
        <label>Mata Kuliah</label>
        <label>:</label>
        <label><?php echo $data2['namamk'];?></label>
      </div>
      <div>
        <label>Nama Kelas</label>
        <label>:</label>
        <label><?php echo $data2['namakelas'];?></label>
      </div>
    </h5>
  </form><br>
  <div class="table-responsive">
    
    <!-- Menampilkan Jadwal Kuliah Berdasarkan tanggal sekarang -->
    <!-- <i class="fa fa-clock-o" style="padding-bottom: 10px;"> Jadwal Kelas</i> -->
    <table class="table table-bordered table-sm table-stripped">
      <thead class="thead-dark">
        <tr align="center" style="font-size: 18px;">
          <th>No</th>
          <th>Tanggal</th>
          <th>Waktu</th>
          <th>Ruangan</th>
          <th>Hadir</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include "../config/koneksi.php";
          $no_urut = 0;
          
          $idkelas = $_GET['idkelas'];

          $sql1    = "SELECT * FROM akademik.ak_perkuliahan INNER JOIN akademik.ak_kelas ON ak_perkuliahan.idkelas = ak_kelas.idkelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk WHERE ak_kelas.idkelas='$idkelas'";
          $hasil1   = pg_query($sql1);

          if(pg_num_rows($hasil1) == 0){
            echo '<tr><td colspan="7" align="center">Tidak Ada Perkuliahan Hari Ini</td></tr>';
          }
          else{

            $no = 1;
            while($data1=pg_fetch_array($hasil1))
          {  
              $no_urut++;
              // $sql1 = "SELECT * FROM public.user";
              // $data1 = pg_exec($sql1);
              echo '<tr align="center">';
                echo '<td><font size="2px">'.$no_urut.'</font></td>';
                
                echo '<td><font size="2px">'.$data1['tgljadwal'].'</font></td>';
                echo '<td><font size="2px">'.$data1['waktumulai'].' s.d. '.$data1['waktuselesai'].'</font></td>';
                echo '<td><font size="2px">'.$data1['idruang'].'</font></td>';
              ?>
                <td>
                  <font size="2px">
                    <?php
                      $tgl    = $data1['tgljadwal'];
                      $jadwal = $data1['idjadwal'];
                      // var_dump($jadwal);
                      // var_dump($tgl);

                      // $queryy = "SELECT * FROM akademik.facerec";
                      // $sqll = pg_query($queryy);
                      // $dataa = pg_fetch_array($sqll);

                      // $idkelas   = $dataa['idkelas'];
                      // var_dump($idkelas);
                      // var_dump($tgl);

                      $sum    = "SELECT COUNT(nim) as jml FROM akademik.ak_absensimhs WHERE idjadwal='$jadwal'";
                      $query  = pg_query($sum);
                      $result = pg_fetch_assoc($query);

                      $total  = $result['jml'];
                      // var_dump($total);
                      echo $total;
                    ?>
                  </font>
                </td>
                <!-- echo '<td><font size="2px"></font></td>'; -->
              <?php
                echo '<td>
                        <a href="index.php?page=facerec&&nimnik='.$data['nimnik'].'&&idjadwal='.$data1['idjadwal'].'"><i class="fas fa-camera"></i></a>&nbsp;&nbsp;&nbsp;
                        <a href="#" style="color: green;"><i class="fas fa-clipboard-list" data-toggle="modal" data-target="#myModal"></i></a>
                      </td>';
              echo '</tr>';
              $no++;
            }
          }
        ?>
      </tbody>
    </table>
  </div>
</div>


<!-- The Modal | Modal Tambah Data-->
  <div class="modal" id="myModal" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
    <div class="modal-dialog">
      <form action="#" method="POST">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Presensi Peserta Kelas</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div style="padding: 10px;" align="right">
            <?php
              include "../config/koneksi.php";
              $idkelas = $_GET['idkelas'];
              $sql3 = "SELECT * FROM akademik.ak_perkuliahan INNER JOIN akademik.ak_kelas ON ak_perkuliahan.idkelas=ak_kelas.idkelas WHERE ak_perkuliahan.idkelas = '$idkelas'";
              $hasil3 = pg_exec($sql3);
              $data3 = pg_fetch_array($hasil3);
              
            ?>
            <a href="index.php?page=facerec&&nimnik=<?php echo $data['nimnik'];?>&&idjadwal=<?php echo $data3['idjadwal'];?>">
              <button type="button" class="btn btn-primary">Take Photo</button>
            </a>
            
          </div>
          
          <div class="container" class="modal-body">
              <table class="table table-bordered table-sm" id="fixed-header">
                <thead class="thead-dark" id="myScrollspy">
                  <tr align="center" style="font-size: 18px;">
                    <th>No</th>
                    <th>NIM</th>
                    <th>Presensi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include "../config/koneksi.php";
                    $no_urut = 0;

                    $sql = "SELECT * FROM akademik.ak_krs INNER JOIN akademik.ak_kelas ON ak_krs.idkelas = ak_kelas.idkelas WHERE ak_kelas.idkelas='$idkelas'";
                    // $sql = "SELECT * FROM public.ak_perkuliahan";
                    $hasil = pg_exec($sql);

                    if(pg_num_rows($hasil) == 0){
                      echo '<tr><td colspan="7" align="center">Tidak Ada Mahasiswa</td></tr>';
                    }
                    else{

                      $no = 1;
                      while($data=pg_fetch_array($hasil)){
                        $no_urut++;
                        // $sql1 = "SELECT * FROM public.user";
                        // $data1 = pg_exec($sql1);
                        echo '<tr align="center">';
                          echo '<td><font size="2px">'.$no_urut.'</font></td>';
                          
                          echo '<td><font size="2px">'.$data['nim'].'</font></td>';
                          
                          echo '<td><input type="text" class="form-control" id="nama" name="nama" style="width:100px;"></td>';
                        echo '</tr>';
                        $no++;
                      }
                    }
                  ?>
                </tbody>
              </table>
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            <a href="#"><button type="submit" class="btn btn-primary">Simpan</button></a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

