<?php
  //menyambungkan koneksi
  include '../config/koneksi.php';
  $tgl    =date("Y-m-d");

  //membaca idkelas
  $idkelas = $_GET['idkelas'];

  $sql1    = "SELECT * FROM ak_perkuliahan INNER JOIN ak_kelas ON ak_perkuliahan.idkelas = ak_kelas.idkelas INNER JOIN ak_matakuliah ON ak_kelas.idmk = ak_matakuliah.idmk WHERE ak_kelas.idkelas='$idkelas' AND ak_perkuliahan.tgljadwal = '$tgl'";
  $hasil1   = pg_query($sql1);
  while($data1=pg_fetch_array($hasil1))
  {

    if(isset($_GET['hal'])) $hal = $_GET['hal'];
      else $hal = 'dkelas';

?>

<div class="container">
  <div class="module-head">
      <h5><large>Data Kelas</large></h5><br>
  </div>
  <div class="container" style="background-color: white; padding-top: 20px;">
	<div class="sidenav">
	  <a href="index.php?page=index&&nimnik=<?php echo $data['nimnik'];?>">Data Kelas</a>
	  <a href="#services">Dosen Pengajar</a>
	  <a href="#clients">Peserta Kelas</a>
	  <a href="#contact">Presensi Kelas</a>
	</div>
	<div>
		<div class="row">
      <input type="hidden" name="nimnik" value="<?php echo $nimnik?>">
      <?php
        if ($hal=='dkelas')
        include ('data-kelas.php');
      ?>
    </div>
	</div>
  </div>
</div>

<?php
  }
?>