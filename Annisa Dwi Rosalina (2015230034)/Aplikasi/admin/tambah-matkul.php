<script type="text/javascript" src="../assets/jquery-3.2.1.min.js"></script>
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h4>Tambah Data Kelas</h4>
    </div>
    <div class="col-sm-6" align="right" style="font-size: 12px;">
      <i class="fas fa-table"></i> 
      <a href="#" style="color: black;">Home</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <a href="#" style="color: black;">Mata Kuliah</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <strong>Tambah Data</strong>
    </div>
  </div>
</div>

<div class="container">
   <div class="container" style="margin-top:20px; background-color: white;">
    <div class="row" align="right">
      <div class="col-sm-12" style="padding-bottom: 10px; padding-top: 10px; border-bottom: thin solid #e6f2ff;">
        <table>
          <tr>
            <td>
              <a href="print_mhs.php" target ="_blank" alig="right">
                <button type="button" class="btn btn-success btn-sm" style="color: white; font-size: 12px;"><i class="fa fa-save"></i> Simpan</button>
              </a>
            </td>
          </tr>
        </table>
        <hr class="d-sm-none">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 sidenav" style="border-right: thin solid #e6f2ff;font-family: 'Source Sans Pro', sans-serif; font-size: 14px; font-weight: bold;color: #697fc9; padding-top: 20px;">
        <div class="container">
          <form action="#" method="POST" class="form-horizontal">
          <div class="form-group row">
              <label class="control-label col-sm-4" for="idmk">ID Kelas</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="idmk" name="idmk" placeholder="ID Kelas">
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-sm-4" for="matkul">Mata Kuliah</label>
              <div class="col-sm-8">
                <!-- <input type="text" class="form-control form-control-sm" id="matkul" name="matkul" placeholder="Mata Kuliah"> -->
                <select class="form-control form-control-sm" id="idmk" name="idmk">
                  <?php
                  include '../config/koneksi.php';
                  $sqlmatkul = "SELECT * FROM akademik.ak_matakuliah";
                  $querymatkul = pg_query($conn,$sqlmatkul);
                  while ($datamatkul = pg_fetch_array($querymatkul)) {
                  ?>
                  <option value="<?php echo $datamatkul['idmk'] ?>">
                    <?php echo $datamatkul["idmk"] ?> | 
                    <?php echo $datamatkul["namamk"] ?>
                  </option>
                  <?php
                      }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-sm-4" for="namakls">Nama Kelas</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="namakls" name="namakls" placeholder="Nama Kelas">
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-sm-4" for="sksmk">SKS Mata Kuliah</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="sksmk" name="sksmk" placeholder="SKS Mata Kuliah">
              </div>
            </div>
        </form>
        </div>
      </div>

      <!-- <div class="col-sm-6 sidenav" style="border-right: thin solid #e6f2ff;font-family: 'Source Sans Pro', sans-serif; font-size: 14px; font-weight: bold;color: #697fc9; padding-top: 20px;">
        <div class="container">
          <form action="#" method="POST" class="form-horizontal">
          <div class="form-group row">
            <label class="control-label col-sm-4" for="idruang">ID Ruang</label>
            <div class="col-sm-8">
              <select class="form-control form-control-sm" id="idruang" name="idruang">
                <option value="T-205">T-205 - Lab Komputer (CISCO/Windows) Menengah Lt2 - 40</option>
                <option value="T-206">T-206 - Lab Komputer (Linux) Menenganh Lt2 - 40</option>
                <option value="T-311">T-311 - Lab Komputer (Windows) Menengahh Lt.3 - 40</option>
                <option value="T-312">T-312 - Lab Komputer (Windows) Menengahh Lt.3 - 40</option>
                <option value="T-401">T-401 - Ruang Kuliah FT Menengah Lt.4 - 45</option>
                <option value="T-402">T-402 - Ruang Kuliah FT Menengah Lt.4 - 45</option>
                <option value="T-403">T-403 - Ruang Teknik Menengah Lt.4 - 45</option>
                <option value="T-405">T-405 - Ruang Teknik Menengah Lt.4 - 45</option>
                <option value="T-406">T-406 - Ruang Kuliah FT Menengah Lt.4 - 80</option>
                <option value="T-409">T-409 - Ruang Kuliah FT Menengah Lt.4 - 40</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="control-label col-sm-4" for="tgljadwal">Tanggal Jadwal</label>
            <div class="col-sm-8">
              <input type="date" class="form-control form-control-sm input-md" id="tgljadwal" name="tgljadwal"/>
            </div>
          </div>

          <div class="form-group row">
            <label class="control-label col-sm-4" for="waktumulai">Tanggal Mulai</label>
            <div class="col-sm-8">
              <!-- <input type="text" class="form-control form-control-sm" id="waktumulai" name="waktumulai" placeholder="Waktu Mulai">
              <select class="form-control form-control-sm" id="waktumulai" name="waktumulai">
                <?php
                include '../config/koneksi.php';
                $sqlmatkul = "SELECT * FROM akademik.ak_matakuliah";
                $query = pg_query($conn,$sqlmatkul);
                while ($datamatkul = pg_fetch_array($querymatkul)) {
                ?>
                <option value="<?php echo $datamatkul['idmk'] ?>">
                  <?php echo $datamatkul["idmk"] ?> | 
                  <?php echo $datamatkul["namamk"] ?>
                </option>
                <?php
                    }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-4" for="waktumulai">Tanggal Mulai</label>
            <div class="col-sm-8">
              <!-- <input type="text" class="form-control form-control-sm" id="waktumulai" name="waktumulai" placeholder="Waktu Mulai">
              <select class="form-control form-control-sm" id="waktumulai" name="waktumulai">
                <?php
                include '../config/koneksi.php';
                $sqlmatkul = "SELECT * FROM akademik.ak_matakuliah";
                $query = pg_query($conn,$sqlmatkul);
                while ($datamatkul = pg_fetch_array($querymatkul)) {
                ?>
                <option value="<?php echo $datamatkul['idmk'] ?>">
                  <?php echo $datamatkul["idmk"] ?> | 
                  <?php echo $datamatkul["namamk"] ?>
                </option>
                <?php
                    }
                ?>
              </select>
            </div>
          </div>
        </form>
      </div> -->
    </div>
  </div> 
</div>