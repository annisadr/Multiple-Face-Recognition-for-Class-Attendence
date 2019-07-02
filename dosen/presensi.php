
<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Presensi Kelas</large></h5><br>
  </div>
<div class="container" style="background-color: white; padding-top: 20px;">

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
          <th>Aksi</th>
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
                echo '<td><a href = "index.php?page=pkelas&&nimnik='.$data['nimnik'].'&&idkelas='.$data1['idkelas'].'"><button type="button" class="btn btn-primary btn-sm">Aksi</button></a></td>';
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
