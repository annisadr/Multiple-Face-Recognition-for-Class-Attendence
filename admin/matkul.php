
<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Mata Kuliah</large></h5><br>
  </div>
<div class="container" style="background-color: white; padding-top: 20px;">

  <div class="table-responsive">
    
    <!-- Menampilkan Jadwal Kuliah Berdasarkan tanggal sekarang -->
    <!-- <?php
    include "../config/koneksi.php";
    $tgl    =date("Y-m-d");
    ?> -->

    <p class="text-left">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
        Tambah Data <i class='fas fa-plus'></i>
      </button>
    </p>

    <i class="fas fa-clipboard-list" style="padding-bottom: 10px;"> Mata Kuliah</i>
    <table class="table table-bordered table-sm">
      <thead class="thead-dark">
        <tr align="center" style="font-size: 18px;">
          <th>No</th>
          <th>Kode</th>
          <th>Jam</th>
          <th>Nama Mata Kuliah</th>
          <th>Kelas</th>
          <th>Dosen Pengajar</th>
          <th>SKS</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include "../config/koneksi.php";
          $no_urut = 0;

          $sql = "SELECT * FROM akademik.ak_kelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk";
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
                
                echo '<td><font size="2px">'.$data['idkelas'].'</font></td>';
                // echo '<td><font size="2px">'.$data['waktumulai'].' - '.$data['waktuselesai'].'</font></td>';
                echo '<td><font size="2px">'.$data['namamk'].'</font></td>';
                echo '<td><font size="2px">'.$data['namakelas'].'</font></td>';
                echo '<td><font size="2px"></font></td>';
                echo '<td><font size="2px">'.$data['sksmk'].'</font></td>';
                echo '<td>
                      <a href=#><i class="fas fa-edit" style="color: orange;" data-toggle="modal" data-target="#ModalEdit"></i></a>
                      
                      &nbsp;&nbsp;&nbsp;
                      
                      <a href="#"><i class="fas fa-trash-alt" style="color: red;"></i></a></td>';
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

<!-- The Modal | Modal Edit Data-->
  <div class="modal" id="ModalEdit">
    <div class="modal-dialog modal-lg">
      <form action="../config/edit-user.php" method="POST">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit Data User</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
              <!-- <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required>
              </div>
              <div class="form-group">
                <label for="nimnik">Nomor Induk:</label>
                <input type="text" class="form-control" id="nimnik" placeholder="Masukkan NIM / NIK" name="nimnik" required>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password" required>
              </div>
              <div class="form-group">
                <label for="level">Level:</label>
                <input type="text" class="form-control" id="level" placeholder="Masukkan Level" name="level" required>
              </div> -->
            <table class="table table-bordered">

            <tr>
              <td style="padding-left: 0px;">
                <p align="left">
                  <!-- <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>"> -->

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="nimnik">NIM</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-5">
                      <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required>
                    </label>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="nama">Nama</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-5">
                      <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required>
                    </label>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-5">
                      <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required>
                    </label>
                    <a href="#" type="button" class="control-label col-sm-2" data-toggle="modal" data-target="#myModal">Ubah Password</a>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="level">Level</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-5">
                      <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required>
                    </label>
                  </div>
                </p>
              </td>
            </tr>
            
          </table>
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            <a href="#"><button type="submit" class="btn btn-primary">Submit</button></a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>