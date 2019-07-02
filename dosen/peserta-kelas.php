<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Peserta Kelas</large></h5><br>
  </div>
  <?php
    $idkelas = $_GET['idkelas'];
    $sql4 = "SELECT * FROM akademik.ak_kelas WHERE ak_kelas.idkelas='$idkelas'";
    $hasil4 = pg_query($sql4);
    $data4 = pg_fetch_array($hasil4);
  ?>
  <div class="sidenav">
    <a href="#about" style="color: blue;">Peserta Kelas</a>
    <a href="index.php?page=lpresensi&&nimnik=<?php echo $data['nimnik'];?>&&idkelas=<?php echo $data4['idkelas'];?>">Presensi Kelas</a>  
  </div>
</div>

<div class="main">
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

          $sql1    = "SELECT * FROM akademik.ak_krs INNER JOIN akademik.ak_kelas ON ak_krs.idkelas = ak_kelas.idkelas WHERE ak_kelas.idkelas='$idkelas'";
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
                echo '<td><font size="2px"></font></td>';
                echo '<td><a href="#"><button type="button" class="btn btn-primary btn-sm"data-toggle="modal" data-target="#myModal" id="detail">Take Photo</button></a></td>';
              echo '</tr>';
              $no++;
            }
          }
        ?>
      </tbody>
    </table>
  </div>
</div>


<!-- The Modal | Modal Tambah Data-->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <form action="#" method="POST" class="form-horizontal">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Take Photo</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
            <div id="container" align="center">
              <video autoplay="true" id="videoElement" width="450px" height="300px">
              
              </video>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <a href="#"><button type="submit" class="btn btn-primary">Start</button></a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

<script type="text/javascript">
  var video = document.querySelector("#videoElement");

  if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true })
      .then(function (stream) {
        video.srcObject = stream;
      })
      .catch(function (err0r) {
        console.log("Something went wrong!");
      });
  }

  // $(document).ready(function(){
  //   $('detail').click(function(){
  //     var url = $(this).attr('href');
  //     $.ajax({
  //       url : url,
  //       success:function(respon){
  //         $('#myModal').html(respon);
  //       }
  //     });
  //   });
  // });
</script>