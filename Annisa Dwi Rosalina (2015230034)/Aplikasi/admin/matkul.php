<!-- isi -->
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h4>Daftar Kelas</h4>
    </div>
    <div class="col-sm-6" align="right" style="font-size: 12px;">
      <i class="fas fa-table"></i> 
      <a href="index.php?page=index&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Home</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <strong>Daftar Kelas</strong>
    </div>
  </div>
</div>

<div class="container" style="margin-top: 20px;">
  <div class="container" style="background-color: white; padding-top: 20px;">
    <div class="table-responsive">    
      <p class="text-right">
        <a href="index.php?page=tkelas" class="btn btn-success btn-sm" role="button"><i class='fas fa-plus'></i> Tambah Data</a>
      </p>

      <i class="fas fa-clipboard-list" style="padding-bottom: 10px;"> Mata Kuliah</i>
      <table class="table table-bordered table-sm" id="example">
        <thead class="thead-dark">
          <tr align="center" style="font-size: 18px;">
            <th>No</th>
            <th>Kode</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Program Studi</th>
            <th>Nama Kelas</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include "../config/koneksi.php";
            $no_urut = 0;

            $sql = "SELECT DISTINCT ak_kelas.idkelas, ak_matakuliah.namamk, ak_matakuliah.sksmk, ak_kelas.namakelas FROM  akademik.ak_kelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk ORDER BY ak_matakuliah.namamk ASC";
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
                  echo '<td><font size="2px">'.$data['sksmk'].'</font></td>';
                  echo '<td><font size="2px">Teknik Informatika</font></td>';
                  echo '<td><font size="2px">'.$data['namakelas'].'</font></td>';
                  echo '<td>
                          <a href="index.php?page=kelas&&idkelas='.$data['idkelas'].'" class="btn btn-info btn-sm" role="button"><i class="fas fa-pencil-alt" style="color:white;"></i></a>
                          <a href="config/proses-deletekelas.php?idkelas='.$data['idkelas'].'" class="btn btn-danger btn-sm" role="button"><i class="far fa-trash-alt"></i></a>
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
</div>