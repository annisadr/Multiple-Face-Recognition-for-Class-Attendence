
<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Dashboard </large></h5><br>
  </div>
<div class="container" style="background-color: white; padding-top: 20px;">

  <div class="table-responsive">
    
    <!-- Menampilkan Jadwal Kuliah Berdasarkan tanggal sekarang -->
    <?php
    include "../config/koneksi.php";
    $tgl    =date("Y-m-d");
    ?>

    <i class="fa fa-clock-o" style="padding-bottom: 10px;"> Jadwal Kelas Hari Ini</i>
    <table class="table table-bordered table-sm">
      <thead class="thead-dark">
        <tr align="center" style="font-size: 18px;">
          <th>No</th>
          <th>Tanggal & Waktu</th>
          <th>Ruangan</th>
          <th>Kuliah</th>
          <th>SKS</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include "../config/koneksi.php";
          $no_urut = 0;

          $sql = "SELECT * FROM akademik.ak_perkuliahan INNER JOIN akademik.ak_kelas ON ak_perkuliahan.idkelas = ak_kelas.idkelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk WHERE ak_perkuliahan.tgljadwal='$tgl'";
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
                
                echo '<td><font size="2px">'.$data['tgljadwal'].' '.$data['waktumulai'].' - '.$data['waktuselesai'].'</font></td>';
                echo '<td><font size="2px">'.$data['namamk'].' (TIF '.$data['namakelas'].')</font></td>';
                echo '<td><font size="2px">'.$data['idruang'].'</font></td>';
                echo '<td><font size="2px">'.$data['sksmk'].'</font></td>';
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
