<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Jadwal Semester Ini</large></h5><br>
  </div>
<div class="container" style="background-color: white; padding-top: 20px;">

  <div class="table-responsive">
    <!-- <div class="col-sm-12" align="right" style="padding-bottom: 20px;">
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"> Tambah</i>
      </button>
    </div> -->
    
    <!-- Menampilkan Jadwal Kuliah Berdasarkan tanggal sekarang -->
    <?php
    include "../config/koneksi.php";
    $tgl    =date("Y-m-d");
    ?>

    <!-- <i class="fas fa-clipboard-list" style="padding-bottom: 10px;"> Jadwal Semester Ini</i> -->
    <table class="table table-bordered table-sm">
      <thead class="thead-dark">
        <tr align="center" style="font-size: 18px;">
          <th>No</th>
          <th>Tanggal</th>
          <th>Mulai</th>
          <th>Selesai</th>
          <th>Kuliah</th>
          <th>Ruang</th>
          <th>Status Presensi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include "../config/koneksi.php";
          $no_urut = 0;
          $nim = $_GET['nimnik'];

          // $query  = "SELECT statushadir FROM akademik.ak_absensimhs
          //             INNER JOIN akademik.ak_perkuliahan ON ak_absensimhs.idjadwal = ak_perkuliahan.idjadwal
          //             INNER JOIN akademik.ak_krs ON ak_perkuliahan.idkelas = ak_krs.idkelas
          //             WHERE ak_krs.nim = '$nim'";
          // $proses = pg_query($query);
          // $data1   = pg_fetch_array($proses);

          $sql = "SELECT tgljadwal, waktumulai, waktuselesai, namamk, namakelas, idruang, nim, idjadwal
                  FROM akademik.ak_krs INNER JOIN akademik.ak_perkuliahan ON ak_krs.idkelas = ak_perkuliahan.idkelas
                  INNER JOIN akademik.ak_kelas ON ak_perkuliahan.idkelas = ak_kelas.idkelas
                  INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk
                  WHERE ak_krs.nim = '$nim'";
          // $sql = "SELECT * FROM public.ak_perkuliahan";
          $hasil = pg_exec($sql);


          if(pg_num_rows($hasil) == 0){
            echo '<tr><td colspan="7" align="center">Tidak Ada Perkuliahan Hari Ini</td></tr>';
          }
          else{
            $no = 1;
            while($data=pg_fetch_array($hasil)){
              $no_urut++;
              echo '<tr align="center">';
                echo '<td><font size="2px">'.$no_urut.'</font></td>';
                echo '<td><font size="2px">'.$data['idjadwal'].'</font></td>'; //nanti ini dihapus
                echo '<td><font size="2px">'.$data['tgljadwal'].'</font></td>';
                echo '<td><font size="2px">'.$data['waktumulai'].'</font></td>';
                echo '<td><font size="2px">'.$data['waktuselesai'].'</font></td>';
                echo '<td><font size="2px">'.$data['namamk'].' (TIF '.$data['namakelas'].')</font></td>';
                echo '<td><font size="2px">'.$data['idruang'].'</font></td>';
              ?>
              <td>
                   <font size="2px">
                    <?php                       
                       $querystatus = "SELECT statushadir FROM akademik.ak_absensimhs WHERE nim = '$nim'";
                       $hasilstatus = pg_query($conn, $querystatus);
                       $tampil      = pg_fetch_array($hasilstatus);

                       if($tampil['statushadir']=='H'){
                         echo 'Hadir';
                       } else {
                        echo 'Alfa';
                       }
                    ?>
                   </font>
                 </td>
                 <?php
                // echo '<td><font size="2px">'.$data1['statushadir'].'</font></td>';
              
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
<?php
  include "../config/koneksi.php";

  $sql2 = "SELECT * FROM akademik.ak_matakuliah";
  // $sql = "SELECT * FROM public.ak_perkuliahan";
  $hasil2 = pg_exec($sql2);
  $data2    = pg_fetch_array($hasil2);
?>
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
      <form action="#" method="POST" class="form-horizontal">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Take Photo</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
            <!-- <table>
              <div class="form-group">
                <tr align="left">
                  <th><label class="control-label col-sm-4" for="matkul">Mata Kuliah</label></th>
                  <th><label class="control-label col-sm-1">:</label></th>
                  <th><input type="text" class="form-control mb-2 mr-sm-2" id="nim" placeholder="Enter NIM" name="nim"></th>
                </tr>
              </div>
            </table> -->
            <table>
              <td><label class="control-label col-sm-4" for="wbws">Mata Kuliah</label></td>
              <td><label class="control-label col-sm-1">:</label></td>
              <td>
                <select name="cars" class="custom-select mb-3">
                  <option selected><?php echo $data2['idmk'];?> | <?php echo $data2['namamk'];?></option>
                </select>
              </td>
            <table>
            
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Trainning</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>