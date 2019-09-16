<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h4>Data Mahasiswa</h4>
    </div>
    <div class="col-sm-6" align="right" style="font-size: 12px;">
      <i class="fas fa-table"></i> 
      <a href="index.php?page=index&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Home</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <strong>Data Mahasiswa</strong>
    </div>
  </div>
</div>

<div class="container" style="margin-top: 20px;">
  <div class="container" style="background-color: white; padding-top: 20px;">
    <div class="table-responsive">    
      <p class="text-right">
        <a href="index.php?page=tkelas&&nimnik=<?php echo $data['nimnik'];?>" class="btn btn-success btn-sm" role="button"><i class='fas fa-plus'></i> Tambah Data</a>
      </p>

      <!-- <i class="fas fa-clipboard-list" style="padding-bottom: 10px;"> Maha</i> -->
      <table class="table table-bordered table-sm" id="example">
        <thead class="thead-dark">
          <tr align="center" style="font-size: 18px;">
            <th>No</th>
            <th>NIM</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include "../config/koneksi.php";

            $sql = pg_query($conn, "SELECT DISTINCT ak_krs.nim FROM akademik.ak_krs INNER JOIN akademik.ak_kelas ON ak_krs.idkelas = ak_kelas.idkelas order by ak_krs.nim ASC");
            $no=0;

            while ($tampil = pg_fetch_array($sql)) {

                $no++;
                // gradasi warna
                if($no%2==1) { $warna=""; } else {$warna="#F5F5F5";}

                echo '<tr bgcolor='.$warna.'>';
                    echo '<td>'.$no.'</td>';  //menampilkan nomor urut
                    echo '<td><font size="2px">'.$tampil['nim'].'</font></td>';
                    echo '<td><a href="index.php?page=takephoto&&nim='.$tampil['nim'].'" class="btn btn-warning btn-sm" role="button"><i class="fas fa-camera"></i></a>
                    </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
      </table>
    </div>

  </div>
</div>