<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Presensi Kelas</large></h5><br>
  </div>
<div class="container" style="background-color: white; padding-top: 20px;">
  <div class="col-sm-12" align="right">
    <a href="index.php?page=tkelas&&nimnik=<?php echo $data['nimnik'];?>" class="btn btn-success btn-sm" role="button"><i class='fas fa-plus'></i> Tambah Data</a>
  </div>

  <div class="table-responsive">
    
    <!-- Menampilkan Jadwal Kuliah Berdasarkan tanggal sekarang -->
    <?php
    include "../config/koneksi.php";
    $tgl    =date("Y-m-d");
    ?>

    <i class="fa fa-clock-o" style="padding-bottom: 10px;"> Mata Kuliah</i>
    <table class="table table-bordered table-sm">
      <thead class="thead-dark">
        <tr align="center" style="font-size: 18px;">
          <th>No</th>
          <th>Kode</th>
          <th>Nama Mata Kuliah</th>
          <th>Kelas</th>
          <th>SKS</th>
          <th colspan="2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include "../config/koneksi.php";
          $no_urut = 0;

          $nimnik = $_GET['nimnik'];
          
          $sql1 = "SELECT * FROM akademik.dosen INNER JOIN akademik.ak_kelas ON dosen.idkelas = ak_kelas.idkelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk WHERE dosen.nik='$nimnik'";
          // $sql = "SELECT * FROM public.ak_perkuliahan";
          $hasil1 = pg_exec($sql1);

          if(pg_num_rows($hasil1) == 0){
            echo '<tr><td colspan="7" align="center">Tidak Ada Perkuliahan Hari Ini</td></tr>';
          }
          else{
            $no = 1;
            while($data1=pg_fetch_array($hasil1)){
              $no_urut++;
              echo '<tr align="center">';
                echo '<td><font size="2px">'.$no_urut.'</font></td>';
                
                echo '<td><font size="2px">'.$data1['idkelas'].'</font></td>';
                echo '<td><font size="2px">'.$data1['namamk'].'</font></td>';
                echo '<td><font size="2px">'.$data1['namakelas'].'</font></td>';
                echo '<td><font size="2px">'.$data1['sksmk'].'</font></td>';
                echo '<td><a href = "index.php?page=pkelas&&nimnik='.$data['nimnik'].'&&idkelas='.$data1['idkelas'].'"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></button></a></td>

                ';
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

<!-- The Modal -->
<div class="modal fade" id="ModalEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Jadwal Perkuliahan</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="table-responsive">
        
          <!-- Menampilkan Jadwal Kuliah Berdasarkan tanggal sekarang -->
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
                // var_dump($sql1); die();
                $hasil1   = pg_query($sql1);

                if(pg_num_rows($hasil1) == 0){
                  echo '<tr><td colspan="7" align="center">Tidak Ada Perkuliahan Hari Ini</td></tr>';
                }
                else{

                $no = 1;
                while($data1=pg_fetch_array($hasil1))
                {  
                    $no_urut++;
                    
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
                            $kelas  = $data1['idkelas'];

                            $sum    = "SELECT COUNT(ak_absensimhs.nim) as jml FROM akademik.ak_absensimhs LEFT JOIN akademik.ak_krs ON ak_absensimhs.nim = ak_krs.nim WHERE idjadwal='$jadwal' AND idkelas='$kelas'";
                            $query  = pg_query($sum);
                            $result = pg_fetch_assoc($query);

                            $total  = $result['jml'];
                            // var_dump($total);
                            echo $total;
                          ?>
                        </font>
                      </td>
                    <?php
                      echo '<td>
                              <a href="../config/proses-deletejadwal.php&&nimnik='.$data['nimnik'].'&&idkelas='.$data1['idkelas'].'&&idjadwal='.$data1['idjadwal'].'" class="btn btn-danger btn-sm" role="button"><i class="far fa-trash-alt"></i></a>
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
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>
