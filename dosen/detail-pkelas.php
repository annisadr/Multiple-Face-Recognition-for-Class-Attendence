<?php
include "../config/koneksi.php";

$nim = $_GET['nim'];
$query = "SELECT * FROM akademik.ak_krs WHERE nim = '$nim'";
$result = pg_query($query);

while($row=pg_fetch_array($result)){
	$nim = $row['nim'];
}
?>

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
</script>