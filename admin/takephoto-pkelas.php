<?php
  include "../config/koneksi.php";
  $no_urut = 0;
  
  $nim = $_GET['nim'];

  $query   = pg_query($conn, "SELECT * FROM akademik.ak_krs WHERE nim='$nim'");
  $data1=pg_fetch_array($query);
?>
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h4>Ambil Foto</h4>
    </div>
    <div class="col-sm-6" align="right" style="font-size: 12px;">
      <i class="fas fa-table"></i> 
      <a href="index.php?page=index" style="color: black;">Home</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <a href="index.php?page=list-mhs" style="color: black;">Data Mahasiswa</a>
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