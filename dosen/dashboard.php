
<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Dashboard </large></h5><br>
  </div>
<div class="container" style="background-color: white; padding-top: 20px;">

  <div class="table-responsive">
    
    <i class="fa fa-clock-o" style="padding-bottom: 10px;"> Jadwal Mengajar Hari Ini</i>
    <table class="table table-bordered table-sm">
      <thead class="thead-dark">
        <tr align="center" style="font-size: 18px;">
          <th>No</th>
          <th>Tanggal & Waktu</th>
          <th>Ruangan</th>
          <th>Kuliah</th>
          <th>SKS</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include "../config/koneksi.php";
          $tgl = date("Y-m-d");
          $no_urut = 0;

          $sql1 = "SELECT * FROM akademik.ak_perkuliahan INNER JOIN akademik.ak_kelas ON ak_perkuliahan.idkelas = ak_kelas.idkelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk WHERE ak_perkuliahan.tgljadwal='$tgl'";
          // $sql = "SELECT * FROM public.ak_perkuliahan";
          $hasil1 = pg_exec($sql1);

          if(pg_num_rows($hasil1) == 0){
            echo '<tr><td colspan="7" align="center">Tidak Ada Perkuliahan Hari Ini</td></tr>';
          }
          else{

            $no = 1;
            while($data1=pg_fetch_array($hasil1)){
              $no_urut++;
              // $sql1 = "SELECT * FROM public.user";
              // $data1 = pg_exec($sql1);
              echo '<tr align="center">';
                echo '<td><font size="2px">'.$no_urut.'</font></td>';
                
                echo '<td><font size="2px">'.$data1['tgljadwal'].' '.$data1['waktumulai'].' - '.$data1['waktuselesai'].'</font></td>';
                echo '<td><font size="2px">'.$data1['namamk'].' (TIF '.$data1['namakelas'].')</font></td>';
                echo '<td><font size="2px">'.$data1['idruang'].'</font></td>';
                echo '<td><font size="2px">'.$data1['sksmk'].'</font></td>';
                echo '<td><a href="index.php?page=lpresensi&&nimnik='.$data['nimnik'].'&&idkelas='.$data1['idkelas'].'"><button type="button" class="btn btn-primary btn-sm">Aksi</button></a></td>';
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
