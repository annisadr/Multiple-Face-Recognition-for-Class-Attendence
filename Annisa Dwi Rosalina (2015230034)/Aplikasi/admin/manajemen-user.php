
<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Manajemen User</large></h5><br>
  </div>
<div class="container" style="background-color: white; padding-top: 20px;">

  <div class="table-responsive">
    
    <!-- Menampilkan Jadwal Kuliah Berdasarkan tanggal sekarang -->
    <?php
    include "../config/koneksi.php";
    $tgl    =date("Y-m-d");
    ?>

    
    <p class="text-right">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
        Tambah Data <i class='fas fa-plus'></i>
      </button>
    </p>

    <i class='fas fa-clipboard-list' style="padding-bottom: 10px;"> Manajemen User</i>
    

    <table class="table table-bordered table-sm">
      <thead class="thead-dark">
        <tr align="center" style="font-size: 18px;">
          <th>No</th>
          <th>Nama</th>
          <th>NIM / NIK</th>
          <th>Level</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include "../config/koneksi.php";
          $no_urut = 0;

          $sql = "SELECT * FROM public.user";
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
                
                echo '<td><font size="2px">'.$data['nama'].'</font></td>';
                echo '<td><font size="2px">'.$data['nimnik'].'</font></td>';
                echo '<td><font size="2px">'.$data['level'].'</font></td>';
                echo '<td>
                      <a href=#><i class="fas fa-user-edit" style="color: orange;" data-toggle="modal" data-target="#ModalEdit"></i></a>
                      
                      &nbsp;&nbsp;&nbsp;
                      
                      <a href="../config/delete-user.php?nimnik='.$data['nimnik'].'"><i class="fas fa-trash-alt" style="color: red;"></i></a></td>';
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
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <form action="../config/add-user.php" method="POST">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Tambah Data User</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
              <div class="form-group">
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
              </div>
            
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

<!-- The Modal | Modal Tambah Data User-->
  <div class="modal" id="ModalEdit">
    <div class="modal-dialog">
      <form action="../config/edit-user.php" method="POST">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit Data User</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
              <div class="form-group">
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
              </div>
            
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