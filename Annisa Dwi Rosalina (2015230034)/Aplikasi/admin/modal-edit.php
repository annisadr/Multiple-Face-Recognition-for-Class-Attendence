<!-- The Modal Edit Jadwal -->
<div class="modal fade" id="edit-jadwal<?php echo $data1['idjadwal']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Jadwal Perkuliahan</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <form action="../config/proses-editjadwal.php" method="POST" class="form-horizontal">
      
      <input type="hidden" name="idjadwal" class="form-control" disabled value="<?php echo $data1['idjadwal'] ?>">
      
      <input type="hidden" name="nim" class="form-control" value="<?php echo $data['nimnik'] ?>" readonly>
      <div class="row" align="right">
        <div class="col-sm-12" style="padding-bottom: 10px; padding-top: 10px; border-bottom: thin solid #e6f2ff; border-color: #28a745;">
          <table>
            <tr>
              <td>
                <button type="submit" class="btn btn-success btn-sm" style="color: white; font-size: 12px;"><i class="fa fa-save"></i> Simpan</button>
                <!-- <input type="submit" class="btn btn-success btn-sm" value="Submit" align="right"><i class="fa fa-save"></i> -->
              </td>
            </tr>
          </table>
          <hr class="d-sm-none">
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 sidenav" style="border-right: thin solid #e6f2ff;font-family: 'Source Sans Pro', sans-serif; font-size: 14px; font-weight: bold;color: #697fc9; padding-top: 20px;">
          <div class="container">
            <div class="form-group row">
              <label class="control-label col-sm-3" for="idkelas">ID Kelas</label>
              <div class="col-sm-7">
                <input type="text" id="idkelas" name="idkelas" class="form-control form-control-sm" readonly value="<?php echo $data1['idkelas'] ?>">
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6" style="font-family: 'Source Sans Pro', sans-serif; font-size: 14px; font-weight: bold;color: #697fc9; padding-top: 20px;">
          <div class="container">
            <div class="form-group row">
              <label class="control-label col-sm-3" for="idjadwal">ID Jadwal</label>
              <div class="col-sm-7">
                <input type="text" id="idjadwal" name="idjadwal" class="form-control form-control-sm" readonly value="<?php echo $data1['idjadwal'] ?>">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row container" style="font-family: 'Source Sans Pro', sans-serif; font-size: 16px; font-weight: bold;color: #697fc9; padding-top: 20px; border-bottom: thick solid #e6f2ff; border-color: #28a745; color: #28a745;">
        Jadwal Mingguan
      </div>

      <div class="row container" align="right">
        <div class="col-sm-4" style="padding-left: 30px; font-family: 'Source Sans Pro', sans-serif; font-size: 14px; font-weight: bold;color: #697fc9; padding-top: 20px;">
          <div class="form-group row">
            Ruangan
            <div class="col-sm-8">
              <?php
 
              (isset($_POST["idruang"])) ? $idruang = $_POST["idruang"] : $idruang=1;
               
              ?>
              <select class="form-control custom-select custom-select-sm" id="idruang" name="idruang">
                <option value="<?php echo $data1['idruang'] ?>"><?php echo $data1['idruang']; ?></option>
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
        </div>
        
        <div class="col-sm-3" style="font-family: 'Source Sans Pro', sans-serif; font-size: 14px; font-weight: bold;color: #697fc9; padding-top: 20px;">
          <div class="form-group row">
            Tanggal
            <div class="col-sm-8">
              <input type="date" class="form-control form-control-sm input-md" id="tgljadwal" name="tgljadwal" value="<?php echo $data1['tgljadwal'] ?>"/>
            </div>
          </div>
        </div>

        <div class="col-sm-4" style="font-family: 'Source Sans Pro', sans-serif; font-size: 14px; font-weight: bold;color: #697fc9; padding-top: 20px;">
          <div class="form-group row">
            Jam
            <div class="col-sm-4">
              <select class="form-control custom-select custom-select-sm" id="waktumulai" name="waktumulai">

                <option value="<?php echo $data1['waktumulai'] ?>"><?php echo $data1['waktumulai']; ?></option>
                <option value="08:00">08:00</option>
                <option value="09:40">09:40</option>
                <option value="10:00">10:00</option>
                <option value="10:30">10:30</option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
                <option value="13:30">13:30</option>
                <option value="14:00">14:00</option>
                <option value="14:30">14:30</option>
                <option value="15:00">15:00</option>
                <option value="15:30">15:30</option>
                <option value="16:00">16:00</option>
                <option value="16:30">16:30</option>
                <option value="17:00">17:00</option>
                <option value="17:30">17:30</option>
                <option value="18:00">18:00</option>
                <option value="18:30">18:30</option>
                <option value="19:00">19:00</option>
                <option value="19:30">19:30</option>
                <option value="20:00">20:00</option>
                <option value="20:30">20:30</option>
                <option value="21:00">21:00</option>
                <option value="21:30">21:30</option>
                <option value="22:00">22:00</option>
              </select>
            </div>
            s.d
            <div class="col-sm-4">
              <select class="form-control custom-select custom-select-sm" id="waktuselesai" name="waktuselesai">
                <option value="<?php echo $data1['waktuselesai'] ?>"><?php echo $data1['waktuselesai']; ?></option>
                <option value="08:00">08:00</option>
                <option value="09:40">09:40</option>
                <option value="10:00">10:00</option>
                <option value="10:30">10:30</option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
                <option value="13:30">13:30</option>
                <option value="14:00">14:00</option>
                <option value="14:30">14:30</option>
                <option value="15:00">15:00</option>
                <option value="15:30">15:30</option>
                <option value="16:00">16:00</option>
                <option value="16:30">16:30</option>
                <option value="17:00">17:00</option>
                <option value="17:30">17:30</option>
                <option value="18:00">18:00</option>
                <option value="18:30">18:30</option>
                <option value="19:00">19:00</option>
                <option value="19:30">19:30</option>
                <option value="20:00">20:00</option>
                <option value="20:30">20:30</option>
                <option value="21:00">21:00</option>
                <option value="21:30">21:30</option>
                <option value="22:00">22:00</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </form>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>