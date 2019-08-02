<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h4>Presensi Kelas</h4>
    </div>
    <div class="col-sm-6" align="right" style="font-size: 12px;">
      <i class="fas fa-table"></i> 
      <a href="index.php?page=index&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Home</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <a href="index.php?page=presensi&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Presensi</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <strong>Presensi Kelas</strong>
    </div>
  </div>
</div>

<div class="container" style="margin-top:20px; background-color: white;">
  <div class="row">
    <div class="col-sm-2 sidenav" style="border-right: thin solid #e6f2ff;">
      <?php
        $idkelas = $_GET['idkelas'];
        $sql4 = "SELECT * FROM akademik.ak_kelas WHERE ak_kelas.idkelas='$idkelas'";
        $hasil4 = pg_query($sql4);
        $data4 = pg_fetch_array($hasil4);
      ?>
      <ul class="nav flex-column" style="padding-top: 20px;">
        <li class="nav-item-side">
          <a class="nav-link" href="index.php?page=pkelas&&nimnik=<?php echo $data['nimnik'];?>&&idkelas=<?php echo $data4['idkelas'];?>">Peserta Kelas</a>
        </li>
        <li class="nav-item-side">
          <a class="nav-link" href="#" style="color: #0099cc;">Presensi Kelas</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>

    <div class="col-sm-10" style="background-color: white;">
      <?php
        $idkelas = $_GET['idkelas'];

        $sql2    = "SELECT * FROM akademik.ak_kelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk WHERE ak_kelas.idkelas='$idkelas'";
        $hasil2   = pg_query($sql2);
        $data2    = pg_fetch_array($hasil2);
      ?>
      
      <form style="padding: 20px;">
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
      </form>
      <div class="table-responsive">
        
        <!-- Menampilkan Jadwal Kuliah Berdasarkan tanggal sekarang -->
        <!-- <i class="fa fa-clock-o" style="padding-bottom: 10px;"> Jadwal Kelas</i> -->
        <table class="table table-bordered table-sm table-stripped">
          <thead class="thead-dark">
            <tr align="center" style="font-size: 15px;">
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
                            <a href="index.php?page=facerec&&nimnik='.$data['nimnik'].'&&idkelas='.$data1['idkelas'].'&&idjadwal='.$data1['idjadwal'].'"><i class="fas fa-camera"></i></a>&nbsp;&nbsp;&nbsp;
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
</div>

<!-- The Modal | Modal Tambah Data-->
  <div class="modal" id="myModal" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
    <div class="modal-dialog">
      <form action="#" method="POST">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title">Presensi Peserta Kelas</h5>
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
            <!-- <a href="index.php?page=facerec&&nimnik=<?php echo $data['nimnik'];?>&&idjadwal=<?php echo $data3['idjadwal'];?>">
              <button type="button" class="btn btn-primary">Take Photo</button>
            </a> -->
            
          </div>
          
          <div class="container" class="modal-body">
            <form>
              <h6 class="sidenav-up">
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
              </h6>
            </form><hr>
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
                    $sql9    = "SELECT * FROM akademik.ak_perkuliahan INNER JOIN akademik.ak_kelas ON ak_perkuliahan.idkelas = ak_kelas.idkelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk WHERE ak_kelas.idkelas='$idkelas'";
                    $hasil9   = pg_query($sql1);
                    $data9  = pg_fetch_array($hasil9);
                    $jadwal = $data9['idjadwal'];
                    $no_urut = 0;
                    
                    $sql = "
                            SELECT a.* , 
                            CASE
                                WHEN b.statushadir = 'A' THEN 'Alfa'
                                WHEN b.statushadir = 'I' THEN 'Izin'
                                WHEN b.statushadir = 'H' THEN 'Hadir'
                                WHEN b.statushadir = 'S' THEN 'Sakit'
                                ELSE 'Alfa'
                            END as status 
                            FROM akademik.ak_krs a 
                            LEFT OUTER JOIN (
                              SELECT nim, statushadir
                              FROM akademik.ak_absensimhs
                              WHERE idjadwal = ".$jadwal."
                                  )b ON a.nim = b.nim
                            WHERE idkelas='".$idkelas."'

                    ";
                    var_dump($sql); die();
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
                        
                          
                  ?>
                    
                          <!-- <td><input type="text" class="form-control" id="nama" name="nama" style="width:100px;"></td> -->
                          <td>
                              <select name="statushadir" class="custom-select col-sm-5" style="font-size: 12px;">
                                <option value="A" <?php if($data['status'] == 'Alfa'){ echo 'selected'; } ?>>Alfa</option>
                                <option value="H" <?php if($data['status'] == 'Hadir'){ echo 'selected'; } ?>>Hadir</option>
                                <option value="I" <?php if($data['status'] == 'Izin'){ echo 'selected'; } ?>>Izin</option>
                                <option value="S" <?php if($data['status'] == 'Sakit'){ echo 'selected'; } ?>>Sakit</option>
                              </select>
                          </td>                          
                        
                         <?php
                                }
                            ?>
                  <?php
                        echo '</tr>';
                        $no++;

                      }
                    // }
                  ?>
                </tbody>
              </table>
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            <a href="#"><button type="submit" class="btn btn-success btn-sm"><i class='fas fa-save'></i> Simpan</button></a>
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>