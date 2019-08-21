<?php
  include "../config/koneksi.php";
  $no_urut = 0;
  
  $nim = $_GET['nim'];

  $query   = pg_query($conn, "SELECT * FROM akademik.ak_krs WHERE nim='$nim'");
  $data1=pg_fetch_array($query);
?>
<div class="container">
  <?php
    $idkelas = $_GET['idkelas'];
    $sql4 = "SELECT * FROM akademik.ak_kelas WHERE ak_kelas.idkelas='$idkelas'";
    $hasil4 = pg_query($sql4);
    $data4 = pg_fetch_array($hasil4);
  ?>
  <div class="row">
    <div class="col-sm-6">
      <h4>Ambil Foto</h4>
    </div>
    <div class="col-sm-6" align="right" style="font-size: 12px;">
      <i class="fas fa-table"></i> 
      <a href="index.php?page=index&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Home</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <a href="index.php?page=presensi&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Presensi</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <a href="index.php?page=pkelas&&nimnik=<?php echo $data['nimnik'];?>&&idkelas=<?php echo $data4['idkelas'];?>" style="color: black;">Peserta Kelas</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <strong>Ambil Foto Mahasiswa</strong>
    </div>
  </div>
</div>

<div class="container" style="background-color: white; padding-bottom: 50px;">
  <form id="takephoto" method="POST">
    <input type="hidden" name="nim" class="form-control" readonly value="<?php echo $data1['nim'] ?>">
    
    <div style="padding-top: 20px">
      <label>NIM</label>
      <label>:</label>
      <label><?php echo $data1['nim'];?></label>
    </div>


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
          if(response == "success") {
              //execute training
              training();
              // reloadserve();
          } else {
             alert('response failed');
          }
        
      },
      error : function(err) {
        alert('eror');
      }
    });

    function training() {
      $.ajax({
        url : 'http://127.0.0.1:5000/training',
        type: 'GET',
        //data : "",
        success : function(response) {
          if(response == "success") {
              //execute reload
              // training();
              reloadserve();
          } else {
             alert('response failed');
          }
        },
        error : function(err) {
          alert('error');
        }  
      });
    }
    
    // function reloadserve() {
    //   $.ajax({
    //     url : 'http://127.0.0.1:5000/restart',
    //     type: 'GET',
    //     //data : "",
    //     success : function(response) {
    //       console.log(response)
    //     },
    //     error : function(err) {
    //       alert('error');
    //     }  
    //   });
    // }
    

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