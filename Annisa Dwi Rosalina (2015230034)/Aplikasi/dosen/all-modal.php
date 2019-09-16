<!-- The Modal Delete Jadwal -->
<div class="modal fade" id="delete_jadwal<?php echo $dataidkelas['idkelas']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Delete Data Jadwal Perkuliahan</h5>
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
                              <a href="../config/proses-deletejadwal.php?nimnik='.$data['nimnik'].'&&idkelas='.$data1['idkelas'].'&&idjadwal='.$data1['idjadwal'].'" class="btn btn-danger btn-sm" role="button"><i class="far fa-trash-alt"></i></a>
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




<!-- EDIT TERMINAL -->
<div class="modal fade" id="edit<?= $data1['nim'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form action="#" method="POST" class="form-horizontal">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Take Photo</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
             
            <input type="text" name="nim" class="form-control" readonly value="<?php echo $data1['nim'] ?>">

            
            <div id="container" align="center">
              <video autoplay="true" id="videoElement" width="450px" height="300px">
              
              </video>
            </div>

          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <a href="#"><button type="submit" class="btn btn-primary">Start</button></a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>