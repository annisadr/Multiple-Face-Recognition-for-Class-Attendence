
<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Data Dosen </large></h5><br>
  </div>
  <div class="container" style="background-color: white; padding-top: 20px;">
    <form class="form-horizontal" action="#" method="POST">

    <div class="panel-group">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <i class="fa fa-clock-o" style="padding-bottom: 10px;"> Data Diri Dosen</i>
        </div>
        <div class="panel-body">
          
          <table class="table table-bordered">

            <tr>
              <td style="padding-left: 200px;">
                <p align="left">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="nimnik">NIM</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-2"><p align="left"><?php echo $data['nimnik']; ?></p></label>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="nama">Nama</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-5"><p align="left"><?php echo $data['nama']; ?></p></label>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-4"><p align="left"><?php echo $data['password']; ?></p></label>
                    <a href="#" type="button" class="control-label col-sm-2" data-toggle="modal" data-target="#myModal">Ubah Password</a>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="level">Level</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-1"><p align="left"><?php echo $data['level']; ?></p></label>
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
