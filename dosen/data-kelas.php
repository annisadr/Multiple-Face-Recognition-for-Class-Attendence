<?php
  //menyambungkan koneksi
  include '../config/koneksi.php';
  $tgl    =date("Y-m-d");

  //membaca idkelas
  $idkelas = $_GET['idkelas'];

  $sql1    = "SELECT * FROM akademik.ak_perkuliahan INNER JOIN akademik.ak_kelas ON ak_perkuliahan.idkelas = ak_kelas.idkelas INNER JOIN akademik.ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk WHERE ak_kelas.idkelas='$idkelas' AND ak_perkuliahan.tgljadwal = '$tgl'";
  $hasil1   = pg_query($sql1);
  while($data1=pg_fetch_array($hasil1))
  {

    if(isset($_GET['hal'])) $hal = $_GET['hal'];
      else $hal = 'dkelas';

?>

<!-- isi -->
<div class="container">
  
  <div class="container" style="background-color: white; padding-top: 20px;">

    <form class="form-horizontal" action="#" method="POST">

    <div class="panel-group">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <i class="fa fa-clock-o" style="padding-bottom: 10px;"> Data Kelas</i>
        </div>
        <div class="panel-body">
          
          <table class="table table-bordered">

            <tr>
              <td style="padding-left: 200px;">
                <p align="left">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="idkelas">Kode Kelas</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-2"><p align="left"><?php echo $data1['idkelas']; ?></p></label>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="namamk">Nama Mata Kuliah</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-5"><p align="left"><?php echo $data1['namamk']; ?></p></label>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="namakelas">Nama Kelas</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-4"><p align="left"><?php echo $data1['namakelas']; ?></p></label>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="waktumulai">Waktu Mulai</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-1"><p align="left"><?php echo $data1['waktumulai']; ?></p></label>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="waktuselesai">Waktu Selesai</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-1"><p align="left"><?php echo $data1['waktuselesai']; ?></p></label>
                  </div>
                </p>
              </td>
            </tr>
            
          </table>
          <p align="right">&nbsp;&nbsp;
              <a href="#"><button type="button" class="btn btn-warning btn-md">Ubah Profil</button></a>
            </p>
        </div>
      </div>
    </div>
  </form>

  </div>
  
</div>

<?php
  }
?>