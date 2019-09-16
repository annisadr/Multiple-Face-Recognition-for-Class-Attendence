
<!-- isi -->
<div class="container">
  <div class="module-head">
      <h5><large>Data Mahasiswa</large></h5><br>
  </div>
  <div class="container" style="background-color: white; padding-top: 20px;">
    <form class="form-horizontal" action="#" method="POST">

    <div class="panel-group">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <i class="fa fa-clock-o" style="padding-bottom: 10px;"> Data Diri Mahasiswa</i>
        </div>
        <div class="panel-body" style="padding-bottom: 10px;">
          
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
                    <label class="control-label col-sm-2" for="level">Level</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-1"><p align="left"><?php echo $data['level']; ?></p></label>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="photos">Photos</label>
                    <label class="control-label col-sm-1">:</label>
                    <label class="control-label col-sm-4"><p align="left"></p></label>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Take Photo</button>
                  </div>
                </p>
              </td>
            </tr>
            
          </table>
          <!-- <p align="right">&nbsp;&nbsp;
            <a href="#"><button type="button" class="btn btn-warning btn-md">Ubah Profil</button></a>
          </p> -->
        </div>
      </div>
    </div>
  </form>
    
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
            <!-- <div class="form-group">
              <table>
                <tr align="left">
                  <th><label class="control-label col-sm-2" for="wbws">NIM</label></th>
                  <th><label class="control-label col-sm-1">:</label></th>
                  <th><input type="text" class="form-control mb-2 mr-sm-2" id="nim" placeholder="Enter NIM" name="nim"></th>
                </tr>
              </table>
            </div> -->

            <!-- <center>
              <canvas id="myCanvas" width="400" height="300" style="border:1px solid #d3d3d3;">
                <video autoplay="true" id="videoElement"></video>
              </canvas>
            </center> -->
            <div id="container" align="center">
              <video autoplay="true" id="videoElement" width="450px" height="300px">
              
              </video>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

<script>
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
</script>