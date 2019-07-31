<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h4>Peserta Kelas</h4>
    </div>
    <div class="col-sm-6" align="right" style="font-size: 12px;">
      <i class="fas fa-table"></i> 
      <a href="index.php?page=index&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Home</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <a href="index.php?page=presensi&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Presensi</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <strong>Peserta Kelas</strong>
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
          <a class="nav-link" href="#" style="color: #0099cc;">Peserta Kelas</a>
        </li>
        <li class="nav-item-side">
          <a class="nav-link" href="index.php?page=lpresensi&&nimnik=<?php echo $data['nimnik'];?>&&idkelas=<?php echo $data4['idkelas'];?>">Presensi Kelas</a>
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
        <!-- <i class="fa fa-clock-o" style="padding-bottom: 10px; font-size: 15px;"> Peserta Kelas</i> -->
        <table class="table table-bordered table-sm table-stripped">
          <thead class="thead-dark">
            <tr align="center" style="font-size: 15px;">
              <th>No</th>
              <th>NIM</th>
              <th>Status Foto</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include "../config/koneksi.php";
              $no_urut = 0;
              
              $idkelas = $_GET['idkelas'];

              $sql1    = "SELECT * FROM akademik.ak_krs INNER JOIN akademik.ak_kelas ON ak_krs.idkelas = ak_kelas.idkelas WHERE ak_kelas.idkelas='$idkelas' order by ak_krs.nim asc";
              $hasil1   = pg_query($sql1);

              if(pg_num_rows($hasil1) == 0){
                echo '<tr><td colspan="7" align="center">Tidak Ada Mahasiswa Terdaftar</td></tr>';
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
                    
                    echo '<td><font size="2px">'.$data1['nim'].'</font></td>';
                    echo '<td><font size="2px">Terdaftar</font></td>';

                  ?>

                    <td><a href="index.php?page=takephoto&&nimnik=<?php echo $data['nimnik'];?>&&nim=<?php echo $data1['nim'];?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span> Take Photo </a>    
                    </td>
                    
                <?php
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
