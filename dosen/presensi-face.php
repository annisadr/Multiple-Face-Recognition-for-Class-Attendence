<?php
include '../config/koneksi.php';

$idjadwal  = $_GET['idjadwal'];

$sql    = "SELECT * FROM akademik.ak_perkuliahan WHERE idjadwal = '$idjadwal'";
$hasil   = pg_query($sql);
$data    = pg_fetch_array($hasil);
?>
<input type="hidden" name="idjadwal" value="<?php echo $data['idjadwal']; ?>">
<link rel="stylesheet" href="css/style.css">
<style type="text/css">
  div.ex1 {
  width: 495px;
  height: 400px;
  overflow: scroll;
}
#fixed-header tbody{
  overflow: auto;
  height: 350;
}
canvas {
  width: 320px;
  height: 240px;
  margin: 10px auto;
  border: 1px solid #babbbd;
}
#player {
  width: 320px;
  height: 240px;
  margin: 10px auto;
  border: 1px solid #babbbd;
}
.center {
  text-align: center;
}
</style>
<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Presensi Kelas</large></h5><br>
  </div>
<div class="container" style="background-color: white; padding-top: 20px; padding-left: 0px;">

  <div class="layout">
  <div id="newImages"></div>
  
  <div class="row" align="center">
    <div class="col-sm-6">
      <video id="player" autoplay></video>
    </div>
      <canvas id="canvas" width="320px" height="240px"></canvas>
      <!-- <input type="" name="canvas" id="canvas"> -->
    </div>
  </div>
  <div class="center">
    <button class="btn btn-primary" id="capture-btn">Capture</button>
    <button class="btn btn-primary" id="upload">Face Recognition</button>
  </div><br>
  <input type="" name="image" class="image-tag">
  <div id="pick-image" align="center">
    <label>Video is not supported. Pick an Image instead</label>
    <input type="file" accept="image/*" id="image-picker">
  </div>
</div>

<script src="../assets/js/script.js"></script>

</div>
  
</div>