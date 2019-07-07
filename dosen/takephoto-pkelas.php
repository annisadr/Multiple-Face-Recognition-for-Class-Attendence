<?php
  include "../config/koneksi.php";
  $no_urut = 0;
  
  $nim = $_GET['nim'];

  $query   = pg_query($conn, "SELECT * FROM akademik.ak_krs WHERE nim='$nim'");
  $data1=pg_fetch_array($query);
?>
<div class="container">
  <div class="module-head">
      <h5><large>Ambil Foto</large></h5><br>
  </div>
</div>
<div class="container" style="background-color: white; padding-bottom: 50px;">
  <form id="takephoto" method="POST">
    <input type="hidden" name="nim" class="form-control" readonly value="<?php echo $data1['nim'] ?>">
    <br><br>

    <div id="container" align="center">
      <!-- <video autoplay="true" id="videoElement" width="450px" height="300px"></video><br> -->
      <button type="submit" data-toggle="tooltip" data-placement="left" title="Ambil Foto" class="btn btn-info btn-lg">Take Photo</button>
    </div>
  </form>
</div>
<script type="text/javascript">
  $('#takephoto').submit(function(e){
    e.preventDefault();
    var data = $('#takephoto').serialize();
    $.ajax({
      url : 'http://127.0.0.1:5000/getpict',
      type : 'POST',
      data : data,
      success : function(response) {
        console.log(response)
      },
      error : function(err) {
        alert('eror');
      }
    });

  });
</script>

<!-- <script type="text/javascript">
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

  $("#takephoto").submit(function(e) {
    var url = "http://127.0.0.1:5000/getpict"; 
    //var xhr = new XMLHttpRequest({mozSystem: true});
    var data = $("#takephoto").serialize();
    console.log("data", data)
    $.ajax({type: "POST",
            url: url,
            data: data,
            success: function(data)
              {
                console.log("getpict ")
              }
          });
  });

  // $(document).ready(function(){
  //   $("#btnTest").click(function(){
  //     // alert("tes")
  //     $.ajax({
  //       type: "POST",
  //       url: "http://127.0.0.1:5000/getpict",
  //       datatype: "JSON",
  //       success : function(response){
  //         console.log("rec")
  //         // var api_url = 'http://127.0.0.1:5000/'
  //       }
  //       // error:function(err){
  //       //   alert('camera not ready');
  //       // }
  //     });
  //   });
  // });
</script> -->

</script>