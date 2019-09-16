<!-- isi -->
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h4>Jadwal Perkuliahan</h4>
    </div>
    <div class="col-sm-6" align="right" style="font-size: 12px;">
      <i class="fas fa-table"></i> 
      <a href="index.php?page=index" style="color: black;">Home</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <a href="index.php?page=matkul" style="color: black;">Data Kelas</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <strong>Jadwal Perkuliahan</strong>
    </div>
  </div>
</div>

<div class="container" style="margin-top: 20px;">
  <div class="container" style="background-color: white; padding-top: 20px;">
    <div class="table-responsive">    
      <p class="text-right">
        <?php
          $idkelas = $_GET['idkelas'];
        ?>
        <a href="index.php?page=tjadwal&&idkelas=<?php echo $idkelas;?>" class="btn btn-success btn-sm" role="button"><i class='fas fa-plus'></i> Tambah Data</a>
      </p>

      <i class="fas fa-clipboard-list" style="padding-bottom: 10px;"> Mata Kuliah</i>
      <table class="table table-bordered table-sm">
        <thead class="thead-dark">
          <tr align="center" style="font-size: 18px;">
            <th>No</th>
            <th>Kode</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Program Studi</th>
            <th>Ruang</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th colspan="2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include "../config/koneksi.php";
            $no_urut = 0;
            $idkelas = $_GET['idkelas'];

            $sql = "SELECT ak_perkuliahan.idjadwal, ak_matakuliah.namamk, ak_matakuliah.sksmk, ak_perkuliahan.idruang, ak_perkuliahan.tgljadwal, ak_perkuliahan.waktumulai, ak_perkuliahan.waktuselesai FROM akademik.ak_perkuliahan INNER JOIN akademik.ak_kelas ON ak_perkuliahan.idkelas = ak_kelas.idkelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk WHERE ak_kelas.idkelas=$idkelas ORDER BY ak_matakuliah.namamk ASC";
            // $sql = "SELECT * FROM public.ak_perkuliahan";
            $hasil = pg_exec($sql);

            if(pg_num_rows($hasil) == 0){
              echo '<tr><td colspan="9" align="center">Tidak Ada Perkuliahan Hari Ini</td></tr>';
            }
            else{
              $no = 1;
              while($data=pg_fetch_array($hasil)){
                $no_urut++;
                echo '<tr align="center">';
                  echo '<td><font size="2px">'.$no_urut.'</font></td>';
                  
                  echo '<td><font size="2px">'.$data['idjadwal'].'</font></td>';
                  // echo '<td><font size="2px">'.$data['waktumulai'].' - '.$data['waktuselesai'].'</font></td>';
                  echo '<td><font size="2px">'.$data['namamk'].'</font></td>';
                  echo '<td><font size="2px">'.$data['sksmk'].'</font></td>';
                  echo '<td><font size="2px">Teknik Informatika</font></td>';
                  echo '<td><font size="2px">'.$data['idruang'].'</font></td>';
                  echo '<td><font size="2px">'.$data['tgljadwal'].'</font></td>';
                  echo '<td><font size="2px">'.$data['waktumulai'].' - '.$data['waktuselesai'].'</font></td>';
          ?>
                  <td>    
                    <a href="#edit-jadwal<?php echo $data['idjadwal'];?>" data-toggle="modal"><i class="fas fa-edit"></i></a>
                    <?php include "modal-edit.php"; ?>
                  </td>

                  
          <?php
                  echo '<td><a href="config/proses-deletejadwal.php?idkelas='.$idkelas.'&&idjadwal='.$data['idjadwal'].'"><i class="fas fa-trash-alt" style="color: red;"></i></a></td>';
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