<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="../assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function detail(id,kelas) {
     // alert(id+" "+kelas);

      $('#myModal').modal('show');
      $.ajax({
          url:'doAjaxDetail.php',
          type:'POST',
          data:{idjadwal:id,idkelas:kelas},
          success:function(result){
            console.log(result);
            var obj = JSON.parse(result);
            var html = "";
            var selected = "selected";
            $.each(obj,function(i,val){
               var option = "";
               html += '<tr align="center">';
               html += ' <td>'+val.no+'</td>';
               html += ' <td>'+val.nim+'</td>';
               if (val.status == 'Alfa') {
                  option = '<option value="A" '+selected+'>Alfa</option>';
               } else if(val.status == 'Hadir')  {
                  option = '<option value="H" '+selected+'>Hadir</option>';
               } else if(val.status == 'Sakit') {
                  option = '<option value="S" '+selected+'>Sakit</option>';
               } else {
                  option = '<option value="I" '+selected+'>Izin</option>';
               }
               html += '<td>';
               html +=    '<select name="statushadir" class="custom-select col-sm-5" style="font-size: 12px;">';
               html +=   option;
               html += '</td>';
               html += '</tr>';
               $('#htmlTd').html(html);

            });

          },
          error:function(err) {
            console.log(err)
          }

      });   
    }

  </script>
 

<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h4>Presensi Kelas</h4>
    </div>
    <div class="col-sm-6" align="right" style="font-size: 12px;">
      <i class="fas fa-table"></i> 
      <a href="index.php?page=index&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Home</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <a href="index.php?page=presensi&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Presensi</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <strong>Presensi Kelas</strong>
    </div>
  </div>
</div>

<div class="container" style="margin-top:20px; background-color: white;">
  <div class="row" align="right">
    <div class="col-sm-12" style="padding-bottom: 10px; border-bottom: thin solid #e6f2ff;">
      <table>
        <tr>
          <td>
            <?php
              $idkelas = $_GET['idkelas'];
              $sqlidkelas = pg_query("SELECT * FROM akademik.ak_kelas WHERE ak_kelas.idkelas='$idkelas'");
              $dataidkelas = pg_fetch_array($sqlidkelas);
            ?>
            <a href="index.php?page=tjadwal&&nimnik=<?php echo $data['nimnik'];?>&&idkelas=<?php echo $dataidkelas['idkelas'];?>" class="btn btn-success btn-sm" role="button"><i class='fas fa-plus'></i> Tambah Data</a>
          </td>

          <td>
            <?php
              $idkelas = $_GET['idkelas'];
              $sqlidkelas = pg_query("SELECT * FROM akademik.ak_kelas WHERE ak_kelas.idkelas='$idkelas'");
              while ($dataidkelas = pg_fetch_array($sqlidkelas)) {
            ?>
            <a href="#delete_jadwal<?php echo $dataidkelas['idkelas']; ?>" class="btn btn-sm" role="button" style="background-color: #f56954; color: white;" data-toggle="modal"><i class='far fa-trash-alt'></i> Hapus Data</a>
           
            <?php
            include 'all-modal.php';
              }
            ?>
          </td>

          <!-- <td>
           <a href="print_mhs.php" class="btn btn-primary btn-sm" role="button"><i class="fa fa-print"></i> Cetak Presensi</a> 
          </td> -->
        </tr>
      </table>
      <hr class="d-sm-none">
    </div>
  </div>
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
          <a class="nav-link" href="index.php?page=pkelas&&nimnik=<?php echo $data['nimnik'];?>&&idkelas=<?php echo $data4['idkelas'];?>">Peserta Kelas</a>
        </li>
        <li class="nav-item-side">
          <a class="nav-link" href="#" style="color: #0099cc;">Presensi Kelas</a>
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
        <table class="table table-bordered table-sm table-stripped">
          <thead class="thead-dark">
            <tr align="center" style="font-size: 15px;">
              <th>No</th>
              <th>Tanggal</th>
              <th>Waktu</th>
              <th>Ruangan</th>
              <th>Hadir</th>
              <th colspan="3">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include "../config/koneksi.php";
              $no_urut = 0;
              
              $idkelas = $_GET['idkelas'];

              $sql1    = "SELECT * FROM akademik.ak_perkuliahan INNER JOIN akademik.ak_kelas ON ak_perkuliahan.idkelas = ak_kelas.idkelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk WHERE ak_kelas.idkelas='$idkelas'";
              // var_dump($sql1); die();
              $hasil1   = pg_query($sql1);

              if(pg_num_rows($hasil1) == 0){
                echo '<tr><td colspan="7" align="center">Tidak Ada Perkuliahan Hari Ini</td></tr>';
              }
              else{

              $no = 1;
              while($data1=pg_fetch_array($hasil1))
              {  
                  $no_urut++;
                  
                  echo '<tr align="center">';
                    echo '<td><font size="2px">'.$no_urut.'</font></td>';
                    
                    echo '<td><font size="2px">'.$data1['tgljadwal'].'</font></td>';
                    echo '<td><font size="2px">'.$data1['waktumulai'].' s.d. '.$data1['waktuselesai'].'</font></td>';
                    echo '<td><font size="2px">'.$data1['idruang'].'</font></td>';
                  ?>
                    <td>
                      <font size="2px">
                        <?php
                          $tgl    = $data1['tgljadwal'];
                          $jadwal = $data1['idjadwal'];
                          $kelas  = $data1['idkelas'];

                          $sum    = "SELECT COUNT(ak_absensimhs.nim) as jml FROM akademik.ak_absensimhs LEFT JOIN akademik.ak_krs ON ak_absensimhs.nim = ak_krs.nim WHERE idjadwal='$jadwal' AND idkelas='$kelas'";
                          $query  = pg_query($sum);
                          $result = pg_fetch_assoc($query);

                          $total  = $result['jml'];
                          // var_dump($total);
                          echo $total;
                        ?>
                      </font>
                    </td>
                  <?php
                    echo '<td>
                            <a href="index.php?page=facerec&&nimnik='.$data['nimnik'].'&&idkelas='.$data1['idkelas'].'&&idjadwal='.$data1['idjadwal'].'"><i class="fas fa-camera"></i></a>
                          </td>';
                    echo '<td> 
                            <button type="button" style="color:#007bff;" id="test" class="btn btn-sm" onclick="detail('.$data1['idjadwal'].','.$data1['idkelas'].')"><i class="fas fa-clipboard-list" style="font-size:17px;"></i></button>
                          </td>';
                  ?>


                    <td>
                            <a href="#edit_jadwal<?php echo $data['nimnik']; echo $data1['idjadwal'];?>" data-toggle="modal"><i class="fas fa-edit"></i></a>
                            <?php include "modal-edit.php"; ?>
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

<!-- The Modal | Modal Absen Manual-->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <form action="#" method="POST">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title">Presensi Peserta Kelas</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="container" class="modal-body">
            <input type="hidden" name="bookId" id="bookId" value=""/>
            <form>
              <h6 class="sidenav-up">
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
              </h6>
            </form><hr>
              <table class="table table-bordered table-sm" id="fixed-header">
                <thead class="thead-dark" id="myScrollspy">
                  <tr align="center" style="font-size: 18px;">
                    <th>No</th>
                    <th>NIM</th>
                    <th>Presensi</th>
                  </tr>
                </thead>
                <tbody id="htmlTd">
                 
                </tbody>
              </table>
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            <a href="#"><button type="submit" class="btn btn-success btn-sm"><i class='fas fa-save'></i> Simpan</button></a>
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>